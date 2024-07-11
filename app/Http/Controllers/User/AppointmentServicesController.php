<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\HandleResponseTrait;
use App\Models\Appointment_service;

class AppointmentServicesController extends Controller
{
    use HandleResponseTrait;
    public function get()
    {
        $Region = Appointment_service::all();
        return $this->handleResponse(
            false,
            "",
            [],
            [$Region],
            [
            ]
        );
    }

}
