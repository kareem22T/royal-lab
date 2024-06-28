<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Visit;
use App\HandleResponseTrait;
use App\SendEmailTrait;

class VisitsController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function index() {
        return view("Admin.visits.all");
    }

    public function indexReview() {
        return view("Admin.visits.reviews");
    }

    public function indexConfirmed() {
        return view("Admin.visits.confirmed");
    }

    public function indexDelivary() {
        return view("Admin.visits.delivary");
    }

    public function indexCompleted() {
        return view("Admin.visits.completed");
    }

    public function indexCanceled() {
        return view("Admin.visits.canceled");
    }

    public function visit($id) {
        $visit = Visit::with(["user"])->find($id);
        if ($visit)
            return view("Admin.visits.visit")->with(compact("visit"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Visit id"],
            [],
            []
        );
    }

    public function approveIndex($id) {
        $visit = Visit::with(["user"])->find($id);
        if ($visit && $visit->status !== 4 && $visit->status !== 0)
            return view("Admin.visits.approve")->with(compact("visit"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Visit status"],
            [],
            []
        );
    }

    public function cancelIndex($id) {
        $visit = Visit::with(["user"])->find($id);
        if ($visit && $visit->status !== 4 && $visit->status !== 0)
            return view("Admin.visits.cancel")->with(compact("visit"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Visit status"],
            [],
            []
        );
    }

    public function approve($id) {
        $visit = Visit::with(["user"])->find($id);

        if ($visit->status === 1) {
            $visit->status = 2;
            $visit->save();
        }

        else if ($visit->status === 2) {
            $visit->status = 3;
            $visit->save();
        }


        if ($visit) {
            return redirect('/admin/visits/visit/success/' . $visit->id);
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
        $visit = Visit::with(["user"])->find($id);

       if ($visit->status != 3 && $visit->status != 0) {
            $visit->status = 0;
            $visit->save();
        }

        if ($visit) {
            return redirect('/admin/visits/visit/success/' . $visit->id);
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
        $visit = Visit::with(["user"])->find($id);
        if ($visit)
            return view("Admin.visits.success")->with(compact("visit"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Visit id"],
            [],
            []
        );
    }

}
