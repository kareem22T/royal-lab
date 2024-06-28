<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Consultation;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.consultations.index');
    }

    public function get() {
        $consultations = Consultation::all();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $consultations
            ],
            []
        );
    }

    public function add() {
        return view("Admin.consultations.create");
    }

    public function edit($id) {
        $consultation = Consultation::find($id);

        if ($consultation)
            return view("Admin.consultations.edit")->with(compact("consultation"));

        return $this->handleResponse(
            false,
            "Consultation not exists",
            ["Consultation id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:100"],
            "name_ar" => ["required", "max:100"],
        ], [
            "name.required" => "ادخل اسم الاستشارة",
            "name.max" => "يجب الا يتعدى اسم الاستشارة 100 حرف",
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

        $consultation = Consultation::create([
            "name" => $request->name,
            "name_ar" => $request->name_ar,
        ]);

        if ($consultation)
            return $this->handleResponse(
                true,
                "تم اضافة الاستشارة بنجاح",
                [],
                [],
                []
            );
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
            "name" => ["required", "max:100"],
            "name_ar" => ["required", "max:100"],
        ], [
            "name.required" => "ادخل اسم الاستشارة",
            "name.max" => "يجب الا يتعدى اسم الاستشارة 100 حرف",
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

        $consultation = Consultation::find($request->id);

        $consultation->name = $request->name;
        $consultation->name_ar = $request->name_ar;
        $consultation->save();

        if ($consultation)
            return $this->handleResponse(
                true,
                "تم تحديث الاستشارة بنجاح",
                [],
                [],
                []
            );
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
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

        $consultation = Consultation::find($request->id);

        $consultation->delete();

        if ($consultation)
            return $this->handleResponse(
                true,
                "تم حذف الاستشارة بنجاح",
                [],
                [],
                []
            );
    }


    public function deleteIndex($id) {
        $Consultation = Consultation::find($id);

        if ($Consultation)
            return view("Admin.consultations.delete")->with(compact("Consultation"));

        return $this->handleResponse(
            false,
            "City not exits",
            ["City id not valid"],
            [],
            []
        );
    }

}
