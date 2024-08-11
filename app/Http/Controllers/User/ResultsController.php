<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\HandleResponseTrait;
use Illuminate\Support\Facades\Http;
use App\Models\Result;
use Illuminate\Support\Facades\Storage;


class ResultsController extends Controller
{
    use HandleResponseTrait;
    public function updateUserResults($request)
    {
        $user = $request->user();
        $watingResults = $user->results()->where("status", 1)->paginate(20);

        foreach ($watingResults as $result) {
            $token = env('ROYAL_TOKEN');
            $billId = $result->bill_id;

            $response = Http::withUrlParameters([
                'token' => $token,
                'billId' => $billId,
            ])->get('https://saudi.crelio.solutions/getOrderStausPDFWithAllReports/?token={token}&billId={billId}');
            $data = json_decode($response, true);

            $status = (isset($data['allReportDetails'])) ? 2 : 1;

            if ($status == 2) {
                $path = $this->generateUniquePath(10);

                // Assuming $request->json('pdfBase64') contains the Base64 string

                $base64String = $data['allReportDetails']['reportDetailsWithBase64'];
                // Decode the Base64 string
                $pdfData = base64_decode($base64String);
                $relativePath = 'pdf/'. $user->name . $path . '.pdf';

                // Store the file in the public storage directory
                $filePath = Storage::disk('public')->put($relativePath, $pdfData);

                // Save the decoded data as a PDF file
                file_put_contents($filePath, $pdfData);

                $storePath = "storage/" . $relativePath;

                $gender = $data['allReportDetails']['Gender'];
                $age = $data['allReportDetails']['Age'];
                $contactNo = $data['allReportDetails']['Contact No'];
                $patientName = $data['allReportDetails']['Patient Name'];
                $bill_id = $data['allReportDetails']['billId'];
                $labPatientId = $data['allReportDetails']['labPatientId'];


                $result->update([
                    'file'=> $storePath,
                    'user_id'=> $user->id,
                    'gender'=> $gender,
                    'age'=> $age,
                    'contact_no'=> $contactNo,
                    'patient_name'=> $patientName,
                    'bill_id'=> $bill_id,
                    'lab_patient_id'=> $labPatientId,
                    'status' => $status
                ]);
            }
        }

    }

    private function generateUniquePath($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }

    public function getUserResults(Request $request) {
        $this->updateUserResults($request);

        $user = $request->user();
        $results = $user->results()->paginate(20);

        return $this->handleResponse(
            true,
            "",
            [],
            $results,
            [
                1 => "waiting",
                2 => "completed",
            ]
        );
    }


}
