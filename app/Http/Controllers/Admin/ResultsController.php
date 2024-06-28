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

    public function getRultsIndex($id) {
        $Results = Result::where("user_id", $id)->get();
        $user = User::find($id);
        if ($user)
        return view("Admin.users.results")->with(compact("user", "Results"));
    }

    public function store(Request $request) {
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

        $file = '';

        if($request->file)
            $file = $this->saveImg($request->file, 'images/uploads/Results');

        $result = Result::create([
            "service_name" => $request->service_name,
            "service_name_ar" => $request->service_name_ar,
            "date" => $request->date,
            "status" => $request->status,
            "user_id" => $request->user_id,
            "file" => $file ? '/images/uploads/Results/' . $file : null,
        ]);

        DB::commit();
            return $this->handleResponse(
                true,
                "تم اضافة النتيجة بنجاح",
                [],
                ["redirct_to" => "/admin/users/" . $request->user_id . "/result/" . $result->id],
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
