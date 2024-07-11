<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Appointment_service;
use Illuminate\Support\Facades\Validator;

class AppointmentServicesController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.appointment_services.index');
    }

    public function get() {
        $appointment_services = Appointment_service::all();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $appointment_services
            ],
            []
        );
    }

    public function add() {
        return view("Admin.appointment_services.create");
    }

    public function edit($id) {
        $appointment_service = Appointment_service::find($id);

        if ($appointment_service)
            return view("Admin.appointment_services.edit")->with(compact("appointment_service"));

        return $this->handleResponse(
            false,
            "Appointment_service not exists",
            ["Appointment_service id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:100"],
            "name_ar" => ["required", "max:100"],
        ], [
            "name.required" => "ادخل اسم المنطقة",
            "name.max" => "يجب الا يتعدى اسم المنطقة 100 حرف",
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

        $appointment_service = Appointment_service::create([
            "name" => $request->name,
            "name_ar" => $request->name_ar,
        ]);

        if ($appointment_service)
            return $this->handleResponse(
                true,
                "تم اضافة المنطقة بنجاح",
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
            "name.required" => "ادخل اسم المنطقة",
            "name.max" => "يجب الا يتعدى اسم المنطقة 100 حرف",
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

        $appointment_service = Appointment_service::find($request->id);

        $appointment_service->name = $request->name;
        $appointment_service->name_ar = $request->name_ar;
        $appointment_service->save();

        if ($appointment_service)
            return $this->handleResponse(
                true,
                "تم تحديث المنطقة بنجاح",
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

        $appointment_service = Appointment_service::find($request->id);

        $appointment_service->delete();

        if ($appointment_service)
            return $this->handleResponse(
                true,
                "تم حذف المنطقة بنجاح",
                [],
                [],
                []
            );
    }


    public function deleteIndex($id) {
        $Appointment_service = Appointment_service::find($id);

        if ($Appointment_service)
            return view("Admin.appointment_services.delete")->with(compact("Appointment_service"));

        return $this->handleResponse(
            false,
            "City not exits",
            ["City id not valid"],
            [],
            []
        );
    }

}
