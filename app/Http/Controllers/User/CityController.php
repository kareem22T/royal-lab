<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\HandleResponseTrait;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    use HandleResponseTrait;
    public function get()
    {
        $cities = City::all();
        return $this->handleResponse(
            false,
            "",
            [],
            [$cities],
            [
            ]
        );
    }
}
