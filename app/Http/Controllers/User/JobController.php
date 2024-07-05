<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use App\Models\Apply_job;
use App\Models\Prescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;

    public function store(Request $request) {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            "file" => ["required"],
            "name" => ["required"],
            "phone" => ["required"],
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
        $file = $this->saveImg($request->file, 'images/uploads/CV');

        $Prescription = Apply_job::create([
            "file_path" => '/images/uploads/CV/' . $file,
            "name" => $request->name,
            "phone" => $request->phone,
            "notes" => $request->notes ?? "N/A"
        ]);

        if ($Prescription) {
            return $this->handleResponse(
                true,
                "تم ارسال طلبك بنجاح سوف نتواصل معك في اقرب وقت",
                [],
                [],
                []
            );
        }
    }
}
