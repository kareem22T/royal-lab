<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\HandleResponseTrait;

class RegionController extends Controller
{
    use HandleResponseTrait;
    public function get()
    {
        $Region = Region::all();
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
