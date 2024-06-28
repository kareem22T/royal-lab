<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.doctors.index');
    }

    public function get() {
        $doctors = Doctor::all();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $doctors
            ],
            []
        );
    }

    public function add() {
        return view("Admin.doctors.create");
    }

    public function edit($id) {
        $doctor = Doctor::with("specializations")->find($id);

        if ($doctor)
            return view("Admin.doctors.edit")->with(compact("doctor"));

        return $this->handleResponse(
            false,
            "Doctor not exists",
            ["Doctor id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:100"],
            "name_ar" => ["required", "max:100"],
            "specializations" => ["required"],
        ], [
            "name.required" => "ادخل اسم الطبيب",
            "name.max" => "يجب الا يتعدى اسم الطبيب 100 حرف",
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

        $doctor = Doctor::create([
            "name" => $request->name,
            "name_ar" => $request->name_ar,
        ]);

        if ($request->specializations && $doctor) {
            foreach ($request->specializations as $Specialization) {
                $option = Specialization::create([
                    "doctor_id" => $doctor->id,
                    "name" => $Specialization["name"],
                    "name_ar" => $Specialization["name_ar"],
                ]);
            }
        }


        if ($doctor)
            return $this->handleResponse(
                true,
                "تم اضافة الطبيب بنجاح",
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
            "specializations" => ["required"],
        ], [
            "name.required" => "ادخل اسم الطبيب",
            "name.max" => "يجب الا يتعدى اسم الطبيب 100 حرف",
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

        $doctor = Doctor::find($request->id);

        $doctor->name = $request->name;
        $doctor->name_ar = $request->name_ar;
        $doctor->save();

        foreach ( $doctor->specializations as $specialization) {
            $specialization->delete();
        }

        if ($request->specializations && $doctor) {
            foreach ($request->specializations as $Specialization) {
                $option = Specialization::create([
                    "doctor_id" => $doctor->id,
                    "name" => $Specialization["name"],
                    "name_ar" => $Specialization["name_ar"],
                ]);
            }
        }


        if ($doctor)
            return $this->handleResponse(
                true,
                "تم تحديث الطبيب بنجاح",
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

        $doctor = Doctor::find($request->id);

        $doctor->delete();

        if ($doctor)
            return $this->handleResponse(
                true,
                "تم حذف الطبيب بنجاح",
                [],
                [],
                []
            );
    }


    public function deleteIndex($id) {
        $Doctor = Doctor::find($id);

        if ($Doctor)
            return view("Admin.doctors.delete")->with(compact("Doctor"));

        return $this->handleResponse(
            false,
            "City not exits",
            ["City id not valid"],
            [],
            []
        );
    }

}
