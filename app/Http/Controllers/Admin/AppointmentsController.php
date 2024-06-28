<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Appointment;
use App\HandleResponseTrait;
use App\SendEmailTrait;

class AppointmentsController extends Controller
{
    use HandleResponseTrait, SendEmailTrait;

    public function index() {
        return view("Admin.appointments.all");
    }

    public function indexReview() {
        return view("Admin.appointments.reviews");
    }

    public function indexConfirmed() {
        return view("Admin.appointments.confirmed");
    }

    public function indexDelivary() {
        return view("Admin.appointments.delivary");
    }

    public function indexCompleted() {
        return view("Admin.appointments.completed");
    }

    public function indexCanceled() {
        return view("Admin.appointments.canceled");
    }

    public function appointment($id) {
        $appointment = Appointment::with(["user"])->find($id);
        if ($appointment)
            return view("Admin.appointments.appointment")->with(compact("appointment"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Appointment id"],
            [],
            []
        );
    }

    public function approveIndex($id) {
        $appointment = Appointment::with(["user"])->find($id);
        if ($appointment && $appointment->status !== 4 && $appointment->status !== 0)
            return view("Admin.appointments.approve")->with(compact("appointment"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Appointment status"],
            [],
            []
        );
    }

    public function cancelIndex($id) {
        $appointment = Appointment::with(["user"])->find($id);
        if ($appointment && $appointment->status !== 4 && $appointment->status !== 0)
            return view("Admin.appointments.cancel")->with(compact("appointment"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Appointment status"],
            [],
            []
        );
    }

    public function approve($id) {
        $appointment = Appointment::with(["user"])->find($id);

        if ($appointment->status === 1) {
            $appointment->status = 2;
            $appointment->save();
        }

        else if ($appointment->status === 2) {
            $appointment->status = 3;
            $appointment->save();
        }


        if ($appointment) {
            return redirect('/admin/appointments/appointment/success/' . $appointment->id);
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
        $appointment = Appointment::with(["user"])->find($id);

       if ($appointment->status != 3 && $appointment->status != 0) {
            $appointment->status = 0;
            $appointment->save();
        }

        if ($appointment) {
            return redirect('/admin/appointments/appointment/success/' . $appointment->id);
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
        $appointment = Appointment::with(["user"])->find($id);
        if ($appointment)
            return view("Admin.appointments.success")->with(compact("appointment"));

        return $this->handleResponse(
            false,
            "",
            ["Invalid Appointment id"],
            [],
            []
        );
    }

}
