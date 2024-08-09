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
    public function get(Request $request)
    {
        $user = $request->user();
        $Region = $user->results()->paginate(20);
        $token = $request->token;
        $billId = $request->bill_id;
        $response = Http::withUrlParameters([
            'token' => $token,
            'billId' => $billId,
        ])->get('https://saudi.crelio.solutions/getOrderStausPDFWithAllReports/?token={token}&billId={billId}');
        
        $path = $this->generateUniquePath(10);
        
        // Assuming $request->json('pdfBase64') contains the Base64 string
         $data = json_decode($response, true);
         if (isset($data['Message'])) {
            return $this->handleResponse(
                false,
                "",
                [],
                [
                    "message"=> $data["Message"],
                ],
                []
                );
         }
         if (isset($data['message'])) {
            Result::create([
                'user_id' => $user->id,
                'message'=> $data['message'],
            ]);
            return $this->handleResponse(
                false,
                "",
                [],
                [$data['message']],
                []
            );
         }
         $base64String = $data['allReportDetails']['reportDetailsWithBase64'];
         // Decode the Base64 string
         $pdfData = base64_decode($base64String);
        // // Define the full file path
        $relativePath = 'pdf/results' . $path . '.pdf';

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


        Result::create([
            'file'=> $storePath,
            'user_id'=> $user->id,
            'gender'=> $gender,
            'age'=> $age,
            'contact_no'=> $contactNo,
            'patient_name'=> $patientName,
            'bill_id'=> $bill_id,
            'lab_patient_id'=> $labPatientId
        ]);
 
        return $this->handleResponse(
            true,
            "",
            [],
            [$response->json(), $Region],
            [
                1 => "waiting",
                2 => "completed",
            ]
        );
    }

    private function generateUniquePath($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }

    public function getResultsForUser(Request $request) {
        $user = $request->user();
        $result = Result::where("user_id", $user->id)->latest()->limit(1)->get();
        $message = $result->whereNotNull("message")->first();
        if (count($result) > 0 && !isset($message)) {
            return $this->handleResponse(
                true,
                "",
                [],
                [
                    "result" => $result,
                ],
                []
            );
        } 
        if (isset($message)) {
        return $this->handleResponse(
            false,
            "",
            [],
            [
                "message" => $message->message,
            ],
            []
        );
        }
        return $this->handleResponse(
            false,
            "Not Found",
            [],
            [],
            []
        );

    }


}
