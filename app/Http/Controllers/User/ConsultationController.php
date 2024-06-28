<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HandleResponseTrait;
use App\Models\Medical_consultation;
use App\Models\Money_request;
use App\Models\Product;
use App\Models\Doctor;
use App\Models\Medical_consultationed_Product;
use Illuminate\Support\Facades\Validator;
use App\SendEmailTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function placeConsultation(Request $request) {
        DB::beginTransaction();

        try {

            $user = $request->user();

            // validate recipient info
            $validator = Validator::make($request->all(), [
                "doctor_id" => ["required"],
                "specialization_id" => ["required"],
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
            $medical_consultation = Medical_consultation::create($request->toArray());

            if ($medical_consultation) {
                $msg_content = "<h1>";
                $msg_content = " طلب استشارة جديد بواسطة" . $user->name;
                $msg_content .= "</h1>";
                $msg_content .= "<br>";
                $msg_content .= "<h3>";
                $msg_content .= "تفاصيل الطلب: ";
                $msg_content .= "</h3>";

                $msg_content .= "<h4>";
                $msg_content .= "اسم المستلم: ";
                $msg_content .= $medical_consultation->name;
                $msg_content .= "</h4>";


                $msg_content .= "<h4>";
                $msg_content .= "رقم هاتف المستلم: ";
                $msg_content .= $medical_consultation->phone;
                $msg_content .= "</h4>";


                $this->sendEmail("kotbekareem74@gmail.com", "طلب جديد", $msg_content);

            }

            DB::commit();

            return $this->handleResponse(
                true,
                "تم ارسال طلب الاستشارة  بنجاح سوف نتواصل معك",
                [],
                [
                    $medical_consultation
                ],
                []
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->handleResponse(
                false,
                "فشل اكمال طلب الاستشارة",
                [$e->getMessage()],
                [],
                []
            );
        }
    }

    public function medical_consultationsAll(Request $request) {
        $user = $request->user();
        $status = $request->status;
        $medical_consultation = $user->medical_consultations()->latest()->with(["user", "doctor", "specialization"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$medical_consultation],
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

    public function medical_consultationsPagination(Request $request) {
        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $medical_consultation = $user->medical_consultations()->latest()->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$medical_consultation],
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

    public function searchMedical_consultationsAll(Request $request) {
        $search = $request->search ? $request->search : '';

        $user = $request->user();
        $status = $request->status;
        $medical_consultation = $user->medical_consultations()->latest()->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->get();

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$medical_consultation],
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

    public function searchMedical_consultationsPagination(Request $request) {
        $search = $request->search ? $request->search : '';

        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        $status = $request->status;
        $medical_consultation = $user->medical_consultations()->latest()->with(["user", "doctor", "specialization"])->when($status !== null, function ($q) use ($status) {
            $q->where("status",  $status);
        })
        ->paginate($per_page);

        return $this->handleResponse(
            true,
            "عملية ناجحة",
            [],
            [$medical_consultation],
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

    public function medical_consultation($id) {
        $medical_consultation = Medical_consultation::with(["user", "doctor", "specialization"])->find($id);
        if ($medical_consultation)
            return $this->handleResponse(
                true,
                "عملية ناجحة",
                [],
                [$medical_consultation],
                []
            );

        return $this->handleResponse(
            false,
            "",
            ["Invalid Medical_consultation id"],
            [],
            []
        );
    }

    public function getDoctors()
    {
        $Doctor = Doctor::with("specializations")->get();
        return $this->handleResponse(
            false,
            "",
            [],
            [$Doctor],
            [
            ]
        );
    }

}
