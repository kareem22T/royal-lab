<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;
include(base_path('routes/admin.php'));

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unauthorized', function () {
    return response()->json(
    [
        "status" => false,
        "message" => "unauthenticated",
        "errors" => ["Your are not authenticated"],
        "data" => [],
        "notes" => []
    ]
    , 401);
});

Route::get("/locale/{lang}", [LocalController::class, "setLocal"]);
