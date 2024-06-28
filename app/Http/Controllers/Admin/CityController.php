<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.cities.index');
    }

    public function get() {
        $cities = City::all();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $cities
            ],
            []
        );
    }

    public function add() {
        return view("Admin.cities.create");
    }

    public function edit($id) {
        $city = City::find($id);

        if ($city)
            return view("Admin.cities.edit")->with(compact("city"));

        return $this->handleResponse(
            false,
            "City not exists",
            ["City id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:100"],
            "name_ar" => ["required", "max:100"],
        ], [
            "name.required" => "ادخل اسم المدينة",
            "name.max" => "يجب الا يتعدى اسم المدينة 100 حرف",
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

        $city = City::create([
            "name" => $request->name,
            "name_ar" => $request->name,
        ]);

        if ($city)
            return $this->handleResponse(
                true,
                "تم اضافة المدينة بنجاح",
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
            "name.required" => "ادخل اسم المدينة",
            "name.max" => "يجب الا يتعدى اسم المدينة 100 حرف",
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

        $city = City::find($request->id);

        $city->name = $request->name;
        $city->name_ar = $request->name_ar;
        $city->save();

        if ($city)
            return $this->handleResponse(
                true,
                "تم تحديث المدينة بنجاح",
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

        $city = City::find($request->id);

        $city->delete();

        if ($city)
            return $this->handleResponse(
                true,
                "تم حذف المدينة بنجاح",
                [],
                [],
                []
            );
    }

    public function deleteIndex($id) {
        $city = City::find($id);

        if ($city)
            return view("Admin.cities.delete")->with(compact("city"));

        return $this->handleResponse(
            false,
            "City not exits",
            ["City id not valid"],
            [],
            []
        );
    }
}
