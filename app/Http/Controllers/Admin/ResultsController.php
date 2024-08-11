<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ResultsController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;
    public function index() {
        return view("Admin.users.index");
    }

    public function uploadResultIndex($id) {
        $user = User::find($id);
        return view("Admin.users.addResult")->with(compact("user"));
    }

    public function Result($id, $result_id) {
        $result = Result::find($result_id);
        $user = User::find($result->user_id);
        if ($user && $result)
        return view("Admin.users.result")->with(compact("user", "result"));
    }
    public function updateUserResults($user)
    {
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



    public function getRultsIndex($id) {
        $user = User::find($id);
        if ($user) {
            $Results = Result::where("user_id", $id)->get();
            $this->updateUserResults($user);
            return view("Admin.users.results")->with(compact("user", "Results"));
        }
    }

    public function store(Request $request) {
        DB::beginTransaction();

        try {

        $validator = Validator::make($request->all(), [
            "service_name" => ["required"],
            "service_name_ar" => ["required"],
            "date" => ["required"],
            "bill_id" => ["required"],
            "user_id" => ["required"],
        ], [
        ]);

        if ($validator->fails()) {
            return $this->handleResponse(
                false,
                "",
                [$validator->errors()->first()],
                [],
                []
            );
        }


        $result = Result::create([
            "service_name" => $request->service_name,
            "service_name_ar" => $request->service_name_ar,
            "date" => $request->date,
            "status" => 1,
            "user_id" => $request->user_id,
            "bill_id" => $request->bill_id,
        ]);

        DB::commit();
            return $this->handleResponse(
                true,
                "تم اضافة النتيجة بنجاح",
                [],
                ["redirct_to" => "/admin/users/" . $request->user_id . "/results"],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل الاضافة",
                [$e->getMessage()],
                [],
                []
            );
        }

    }

    public function update(Request $request) {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                "service_name" => ["required"],
                "service_name_ar" => ["required"],
                "date" => ["required"],
                "status" => ["required"],
                "user_id" => ["required"],
            ], [
            ]);

            if ($validator->fails()) {
                return $this->handleResponse(
                    false,
                    "",
                    [$validator->errors()->first()],
                    [],
                    []
                );
            }

            $result = Result::findOrFail($request->id);

            if($request->file) {
                // Delete the old file if exists
                if ($result->file) {
                    $oldFilePath = public_path($result->file);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $file = $this->saveImg($request->file, 'images/uploads/Results');
                $result->file = '/images/uploads/Results/' . $file;
            }

            $result->update([
                "service_name" => $request->service_name,
                "service_name_ar" => $request->service_name_ar,
                "date" => $request->date,
                "status" => $request->status,
                "user_id" => $request->user_id,
            ]);

            DB::commit();

            return $this->handleResponse(
                true,
                "تم تحديث النتيجة بنجاح",
                [],
                ["redirect_to" => "/admin/users/" . $result->user_id . "/result/" . $request->id],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل التحديث",
                [$e->getMessage()],
                [],
                []
            );
        }
    }

}
