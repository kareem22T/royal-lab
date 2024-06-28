<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use App\Models\Prescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PrescriptionsController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;

    public function store(Request $request) {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            "file" => ["required"],
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
        $file = $this->saveImg($request->file, 'images/uploads/Prescriptions');

        $Prescription = Prescription::create([
            "file_path" => '/images/uploads/Prescriptions/' . $file,
            "user_id" => $user->id,
            "notes" => $request->notes ?? null
        ]);

        if ($Prescription) {
            return $this->handleResponse(
                true,
                "تم ارسال الروشتة بنجاح سوف نتواصل معك في اقرب وقت",
                [],
                [],
                []
            );
        }
    }
}
