<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\HandleResponseTrait;

class ResultsController extends Controller
{
    use HandleResponseTrait;
    public function get(Request $request)
    {
        $user = $request->user();
        $Region = $user->results()->paginate(20);
        return $this->handleResponse(
            false,
            "",
            [],
            $Region,
            [
                1 => "waiting",
                2 => "completed",
            ]
        );
    }

}
