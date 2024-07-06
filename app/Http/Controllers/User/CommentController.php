<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\SaveImageTrait;
use App\DeleteImageTrait;
use App\Models\Apply_job;
use App\Models\Comment;
use App\Models\Prescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use HandleResponseTrait, SaveImageTrait, DeleteImageTrait;

    public function get() {
        return Comment::where("show", true);
    }
    public function store(Request $request) {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            "comment" => ["required"],
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

        $request["name"] = $user->name;
        $request["email"] = $user->email;
        $request["phone"] = $user->phone;

        $Prescription = Comment::create($request->toArray());

        if ($Prescription) {
            return $this->handleResponse(
                true,
                "تم استقبال تقيمك بنجاح ",
                [],
                [],
                []
            );
        }
    }

    public function toggleShow(Request $request) {
        $id = $request->input("id", 0);
        $comment = Comment::find($id);

        if ($comment) {
            $comment->show = !$comment->show;
            $comment->save();
        }
    }
}
