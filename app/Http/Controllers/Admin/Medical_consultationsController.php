<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Medical_consultation;
use App\HandleResponseTrait;
use App\SendEmailTrait;

class Medical_consultationsController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function index() {
        return view("Admin.medical_consultations.all");
    }

    public function indexReview() {
        return view("Admin.medical_consultations.reviews");
    }

    public function indexConfirmed() {
        return view("Admin.medical_consultations.confirmed");
    }

    public function indexDelivary() {
        return view("Admin.medical_consultations.delivary");
    }

    public function indexCompleted() {
        return view("Admin.medical_consultations.completed");
    }

    public function indexCanceled() {
        return view("Admin.medical_consultations.canceled");
    }

    public function medical_consultation($id) {
        $medical_consultation = Medical_consultation::with(["user", "doctor", "specialization"])->find($id);
        if ($medical_consultation)
            return view("Admin.medical_consultations.medical_consultation")->with(compact("medical_consultation"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Medical_consultation id"],
            [],
            []
        );
    }

    public function approveIndex($id) {
        $medical_consultation = Medical_consultation::with(["user"])->find($id);
        if ($medical_consultation && $medical_consultation->status !== 4 && $medical_consultation->status !== 0)
            return view("Admin.medical_consultations.approve")->with(compact("medical_consultation"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Medical_consultation status"],
            [],
            []
        );
    }

    public function cancelIndex($id) {
        $medical_consultation = Medical_consultation::with(["user"])->find($id);
        if ($medical_consultation && $medical_consultation->status !== 4 && $medical_consultation->status !== 0)
            return view("Admin.medical_consultations.cancel")->with(compact("medical_consultation"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Medical_consultation status"],
            [],
            []
        );
    }

    public function approve($id) {
        $medical_consultation = Medical_consultation::with(["user"])->find($id);

        if ($medical_consultation->status === 1) {
            $medical_consultation->status = 2;
            $medical_consultation->save();
        }

        else if ($medical_consultation->status === 2) {
            $medical_consultation->status = 3;
            $medical_consultation->save();
        }


        if ($medical_consultation) {
            return redirect('/admin/medical_consultations/medical_consultation/success/' . $medical_consultation->id);
        }

        return $this->handleResponse(
            false,
            "",
            ["Fail Proccess"],
            [],
            []
        );
    }

    public function cancel($id) {
        $medical_consultation = Medical_consultation::with(["user"])->find($id);

       if ($medical_consultation->status != 3 && $medical_consultation->status != 0) {
            $medical_consultation->status = 0;
            $medical_consultation->save();
        }

        if ($medical_consultation) {
            return redirect('/admin/medical_consultations/medical_consultation/success/' . $medical_consultation->id);
        }

        return $this->handleResponse(
            false,
            "",
            ["Fail Proccess"],
            [],
            []
        );
    }

    public function successIndex($id) {
        $medical_consultation = Medical_consultation::with(["user"])->find($id);
        if ($medical_consultation)
            return view("Admin.medical_consultations.success")->with(compact("medical_consultation"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Medical_consultation id"],
            [],
            []
        );
    }

}
