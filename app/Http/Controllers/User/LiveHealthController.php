<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\LiveHealthApiService;
use Illuminate\Http\Request;

class LiveHealthController extends Controller
{
    protected $liveHealthApiService;

    public function __construct(LiveHealthApiService $liveHealthApiService)
    {
        $this->liveHealthApiService = $liveHealthApiService;
    }

    public function showResults(Request $request)
    {
        $parameters = $request->all();
        $results = $this->liveHealthApiService->getResults($parameters);

        return response()->json($results);
    }
}

