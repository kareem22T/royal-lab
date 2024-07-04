<?php

namespace App\Http\Controllers;

use App\HandleResponseTrait;
use App\Models\Companies_msg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyMsgsController extends Controller
{
    use HandleResponseTrait;
    public function placeMsg(Request $request) {
        DB::beginTransaction();

        try {

            $user = $request->user();

            // validate recipient info
            $validator = Validator::make($request->all(), [
                "where" => ["required"],
                "name" => ["required", "string"],
                "email" => ["required"],
                "subject" => ["required"],
            ]);

            if ($validator->fails()) {
                return $this->handleResponse(
                    false,
                    "",
                    [$validator->errors()->first()],
                    [],
                    [],
                );
            }
            $request["notes"] = $request["notes"] ?? "N\A";
            $appointment = Companies_msg::create($request->toArray());

            DB::commit();

            return $this->handleResponse(
                true,
                "تم ارسال طلبك  بنجاح سوف نتواصل معك",
                [],
                [
                    $appointment
                ],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل اكمال احجز",
                [$e->getMessage()],
                [],
                []
            );
        }
    }


}
