<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Visit;
use Carbon\Carbon;
use App\Models\Money_request;
use Illuminate\Support\Facades\Validator;
use App\SendEmailTrait;
use Illuminate\Support\Facades\DB;

class VisitsController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function placeVisit(Request $request) {
        DB::beginTransaction();

        try {

            $user = $request->user();

            // validate recipient info
            $validator = Validator::make($request->all(), [
                "date" => ["required"],
                "address" => ["required", "string"],
                "service" => ["required"],
                "phone" => ["required"],
            ], [
            ]);

            if ($validator->fails()) {
                return $this->handleResponse(
                    false,
                    "فشل",
                    [$validator->errors()->first()],
                    [
                    ],
                    []
                );
            }

            $request["user_id"] = $user->id;
            $request["date"] = new Carbon($request["date"]);
            $visit = Visit::create($request->toArray());

            if ($visit) {
                $msg_content = "<h1>";
                $msg_content = " طلب زيارة جديد بواسطة" . $user->name;
                $msg_content .= "</h1>";
                $msg_content .= "<br>";
                $msg_content .= "<h3>";
                $msg_content .= "تفاصيل الطلب زيارة: ";
                $msg_content .= "</h3>";

                $msg_content .= "<h4>";
                $msg_content .= "عنوان  الطلب: ";
                $msg_content .= $visit->address;
                $msg_content .= "</h4>";


                $this->sendEmail("info@royalab-sa.com", "طلب زيارة جديد", $msg_content);

            }

            DB::commit();

            return $this->handleResponse(
                true,
                "تم تلقي الطلب بنجاح",
                [],
                [
                    $visit
                ],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل اكمال الطلب زيارة",
                [$e->getMessage()],
                [],
                []
            );
        }
    }

    public function visitsAll(Request $request) {
        $user = $request->user();
        $status = $request->status;
        $visit = $user->visits()->latest()->with(["user"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$visit],
            [
                "parameters" => [
                    "note" => "ال status مش مفروضة",
                    "status" => [
                        1 => "تحت المراجعة",
                        2 => "تم التاكيد",
                        3 => "اكتمل",
                        0 => "فشل او الغى",
                    ]
                ]
            ]
        );
    }

    public function visitsPagination(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $visit = $user->visits()->latest()->with(["user"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$visit],
            [
                "parameters" => [
                    "note" => "ال status مش مفروضة",
                    "status" => [
                        1 => "تحت المراجعة",
                        2 => "تم التاكيد",
                        3 => "اكتمل",
                    ]
                ]
            ]
        );
    }

    public function searchVisitsAll(Request $request) {
        $search = $request->search ? $request->search : '';

        $user = $request->user();
        $status = $request->status;
        $visit = $user->visits()->latest()->with([ "user"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$visit],
            [
                "parameters" => [
                    "note" => "ال status مش مفروضة",
                    "status" => [
                        1 => "تحت المراجعة",
                        2 => "تم التاكيد",
                        3=> "اكتمل",
                    ]
                ]
            ]
        );
    }

    public function searchVisitsPagination(Request $request) {
        $search = $request->search ? $request->search : '';

        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $visit = $user->visits()->latest()->with(["user"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$visit],
            [
                "parameters" => [
                    "note" => "ال status مش مفروضة",
                    "status" => [
                        1 => "تحت المراجعة",
                        2 => "تم التاكيد",
                        3 => "اكتمل",
                        0 => "فشل او الغى",
                    ]
                ]
            ]
        );
    }

    public function visit($id) {
        $visit = Visit::with(["user"])->find($id);
        if ($visit)
            return $this->handleResponse(
                true,
                "عملية ناجحة",
                [],
                [$visit],
                []
            );

        return $this->handleResponse(
            false,
            "",
            ["Invalid Visit id"],
            [],
            []
        );
    }

}
