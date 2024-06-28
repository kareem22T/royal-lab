<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.regions.index');
    }

    public function get() {
        $regions = Region::all();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $regions
            ],
            []
        );
    }

    public function add() {
        return view("Admin.regions.create");
    }

    public function edit($id) {
        $region = Region::find($id);

        if ($region)
            return view("Admin.regions.edit")->with(compact("region"));

        return $this->handleResponse(
            false,
            "Region not exists",
            ["Region id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "max:100"],
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

        $region = Region::create([
            "name" => $request->name,
        ]);

        if ($region)
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

        $region = Region::find($request->id);

        $region->name = $request->name;
        $region->save();

        if ($region)
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

        $region = Region::find($request->id);

        $region->delete();

        if ($region)
            return $this->handleResponse(
                true,
                "تم حذف المنطقة بنجاح",
                [],
                [],
                []
            );
    }


    public function deleteIndex($id) {
        $Region = Region::find($id);

        if ($Region)
            return view("Admin.regions.delete")->with(compact("Region"));

        return $this->handleResponse(
            false,
            "City not exits",
            ["City id not valid"],
            [],
            []
        );
    }

}
