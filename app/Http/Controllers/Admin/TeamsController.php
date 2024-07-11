<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use App\Models\Team;
use App\Models\Option;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TeamsController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;

    public function index() {
        return view('Admin.teams.index');
    }

    public function add() {
        return view("Admin.teams.create");
    }

    public function edit($id) {
        $team = Team::latest()->find($id);

        if ($team)
            return view("Admin.teams.edit")->with(compact("team"));

        return $this->handleResponse(
            false,
            "Team not exits",
            ["Team id not valid"],
            [],
            []
        );
    }

    public function create(Request $request) {
        DB::beginTransaction();

        try {

        $validator = Validator::make($request->all(), [
            "name" => ["required"],
            "position" => ["required"],
            "name_ar" => ["required"],
            "position_ar" => ["required"],
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            "name.required" => "ادخل اسم الخدمة",
            "main_image.required" => "ارفع الصورة الرئيسية للخدمة",
            "category_id.required" => "اختر القسم",
            "description.required" => "ادخل وصف الخدمة",
            "quantity.required" => "ادخل الكمية المتاحة من الخدمة",
            "price.required" => "ادخل سعر الخدمة الخدمة",
            "images.required" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.min_images" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.mimes" => "يجب ان تكون الصورة بين هذه الصيغ (jpeg, png, jpg, gif)",
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

        $main_image_name = $this->saveImg($request->main_image, 'images/uploads/Team');
        $team = Team::create([
            "name" => $request->name,
            "position" => $request->position,
            "name_ar" => $request->name_ar,
            "position_ar" => $request->position_ar,
            "photo_path" => '/images/uploads/Team/' . $main_image_name,
        ]);

        DB::commit();
            return $this->handleResponse(
                true,
                "تم اضافة العضو بنجاح",
                [],
                [],
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
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
            "name" => ["required"],
            "position" => ["required"],
            "name_ar" => ["required"],
            "position_ar" => ["required"],
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            "name.required" => "ادخل اسم الخدمة",
            "description.required" => "ادخل وصف الخدمة",
            "quantity.required" => "ادخل الكمية المتاحة من الخدمة",
            "price.required" => "ادخل سعر الخدمة الخدمة",
            "images.required" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.min_images" => "يجب ان ترفع ما لايقل عن 4 صور لكل خدمة ",
            "images.mimes" => "يجب ان تكون الصورة بين هذه الصيغ (jpeg, png, jpg, gif)",
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

        $team = Team::find($request->id);
        if ($request->main_image) {
            $main_image_name = $this->saveImg($request->main_image, 'images/uploads/Teams');
            $team->photo_path = '/images/uploads/Teams/' . $main_image_name;
        }

        $team->name = $request->name;
        $team->position = $request->position;
        $team->name_ar = $request->name_ar;
        $team->position_ar = $request->position_ar;

        $team->save();

        if ($team)
            return $this->handleResponse(
                true,
                "تم تحديث العضو بنجاح",
                [],
                [],
                []
            );

    }

    public function deleteIndex($id) {
        $team = Team::find($id);

        if ($team)
            return view("Admin.teams.delete")->with(compact("team"));

        return $this->handleResponse(
            false,
            "Team not exits",
            ["Team id not valid"],
            [],
            []
        );
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            "id" => ["required"],
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

        $team = Team::find($request->id);

        $team->delete();

        if ($team)
            return $this->handleResponse(
                true,
                "تم حذف الخدمة بنجاح",
                [],
                [],
                []
            );

    }
}
