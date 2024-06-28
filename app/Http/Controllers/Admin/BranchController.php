<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Branch;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    use HandleResponseTrait;

    public function index() {
        return view('Admin.branches.index');
    }

    public function get() {
        $branches = Branch::with(['city', 'region'])->get();

        return $this->handleResponse(
            true,
            "",
            [],
            [
                $branches
            ],
            []
        );
    }

    public function add() {
        $cities = City::all();
        $regions = Region::all();
        return view("Admin.branches.create", compact('cities', 'regions'));
    }

    public function edit($id) {
        $branch = Branch::find($id);
        $cities = City::all();
        $regions = Region::all();

        if ($branch)
            return view("Admin.branches.edit", compact('branch', 'cities', 'regions'));

        return $this->handleResponse(
            false,
            "Branch not exists",
            ["Branch id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "address" => ["required"],
            "address_ar" => ["required"],
            "phone" => ["required"],
            "city_id" => ["required", "integer"],
            "region_id" => ["required", "integer"],
        ], [
            "address.required" => "ادخل العنوان",
            "phone.required" => "ادخل رقم الهاتف",
            "city_id.required" => "ادخل المدينة",
            "city_id.integer" => "معرف المدينة غير صحيح",
            "region_id.required" => "ادخل المنطقة",
            "region_id.integer" => "معرف المنطقة غير صحيح",
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

        $branch = Branch::create([
            "address" => $request->address,
            "address_ar" => $request->address_ar,
            "phone" => $request->phone,
            "city_id" => $request->city_id,
            "region_id" => $request->region_id,
        ]);

        if ($branch)
            return $this->handleResponse(
                true,
                "تم اضافة الفرع بنجاح",
                [],
                [],
                []
            );
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
            "address" => ["required"],
            "address_ar" => ["required"],
            "phone" => ["required"],
            "city_id" => ["required", "integer"],
            "region_id" => ["required", "integer"],
        ], [
            "address.required" => "ادخل العنوان",
            "phone.required" => "ادخل رقم الهاتف",
            "city_id.required" => "ادخل المدينة",
            "city_id.integer" => "معرف المدينة غير صحيح",
            "region_id.required" => "ادخل المنطقة",
            "region_id.integer" => "معرف المنطقة غير صحيح",
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

        $branch = Branch::find($request->id);

        $branch->address = $request->address;
        $branch->address_ar = $request->address_ar;
        $branch->phone = $request->phone;
        $branch->city_id = $request->city_id;
        $branch->region_id = $request->region_id;
        $branch->save();

        if ($branch)
            return $this->handleResponse(
                true,
                "تم تحديث الفرع بنجاح",
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

        $branch = Branch::find($request->id);

        $branch->delete();

        if ($branch)
            return $this->handleResponse(
                true,
                "تم حذف الفرع بنجاح",
                [],
                [],
                []
            );
    }
    public function deleteIndex($id) {
        $Branch = Branch::find($id);

        if ($Branch)
            return view("Admin.branches.delete")->with(compact("Branch"));

        return $this->handleResponse(
            false,
            "Branch not exits",
            ["Branch id not valid"],
            [],
            []
        );
    }

}
