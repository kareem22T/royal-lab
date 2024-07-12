<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Appointment;
use App\Models\Money_request;
use App\Models\Product;
use App\Models\Appointmented_Product;
use Illuminate\Support\Facades\Validator;
use App\SendEmailTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentsController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function placeAppointment(Request $request) {
        DB::beginTransaction();

        try {

            $user = $request->user();

            // validate recipient info
            $validator = Validator::make($request->all(), [
                "name" => ["required"],
                "age" => ["required", "string"],
                "phone" => ["required"],
                "branch_id" => ["required"],
                "service" => ["required"],
                "date" => ["required"],
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
            $request["user_id"] = $user->id;
            $request["date"] = new Carbon($request["date"]);
            $request["service_id"] = 0;
            $appointment = Appointment::create($request->toArray());

            if ($appointment) {
                $msg_content = "<h1>";
                $msg_content = " حجز جديد بواسطة" . $user->name;
                $msg_content .= "</h1>";
                $msg_content .= "<br>";
                $msg_content .= "<h3>";
                $msg_content .= "تفاصيل الحجز: ";
                $msg_content .= "</h3>";

                $msg_content .= "<h4>";
                $msg_content .= "اسم المستلم: ";
                $msg_content .= $appointment->name;
                $msg_content .= "</h4>";


                $msg_content .= "<h4>";
                $msg_content .= "رقم هاتف المستلم: ";
                $msg_content .= $appointment->phone;
                $msg_content .= "</h4>";


                $this->sendEmail("info@royalab-sa.com", "طلب جديد", $msg_content);

            }

            DB::commit();

            return $this->handleResponse(
                true,
                "تم ارسال الحجز  بنجاح سوف نتواصل معك",
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

    public function appointmentsAll(Request $request) {
        $user = $request->user();
        $status = $request->status;
        $appointment = $user->appointments()->latest()->with(["user", "service", "branch"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$appointment],
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

    public function appointmentsPagination(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $appointment = $user->appointments()->latest()->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$appointment],
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

    public function searchAppointmentsAll(Request $request) {
        $search = $request->search ? $request->search : '';

        $user = $request->user();
        $status = $request->status;
        $appointment = $user->appointments()->latest()->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
        })
        ->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$appointment],
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

    public function searchAppointmentsPagination(Request $request) {
        $search = $request->search ? $request->search : '';

        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $appointment = $user->appointments()->latest()->with(["user", "service", "branch"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ;
        })
        ->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$appointment],
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

    public function appointment($id) {
        $appointment = Appointment::with(["user", "service", "branch"])->find($id);
        if ($appointment)
            return $this->handleResponse(
                true,
                "عملية ناجحة",
                [],
                [$appointment],
                []
            );

        return $this->handleResponse(
            false,
            "",
            ["Invalid Appointment id"],
            [],
            []
        );
    }

}
