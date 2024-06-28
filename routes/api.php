<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\User\TransactionsController;
use App\Http\Controllers\User\HomeEndpoints;
use App\Http\Controllers\User\RegionController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\BranchController;

// Users endpoints
Route::post("/user/register", [AuthController::class, "register"]);
Route::get('/user/ask-email-verfication-code', [AuthController::class, "askEmailCode"])->middleware('auth:sanctum');
Route::post('/user/verify-email', [AuthController::class, "verifyEmail"])->middleware('auth:sanctum');
Route::post('/user/change-password', [AuthController::class, "changePassword"])->middleware('auth:sanctum');
Route::post('/user/ask-for-forgot-password-email-code', [AuthController::class, "askEmailCodeForgot"]);
Route::post('/user/forgot-password', [AuthController::class, "forgetPassword"]);
Route::post('/user/forgot-password-check-code', [AuthController::class, "forgetPasswordCheckCode"]);
Route::get('/user/get', [AuthController::class, "getUser"])->middleware('auth:sanctum');
Route::post('/user/login', [AuthController::class, "login"]);
Route::post('/user/update', [AuthController::class, "update"])->middleware('auth:sanctum');
Route::get('/user/logout', [AuthController::class, "logout"])->middleware('auth:sanctum');

// Products endpoints
Route::get("/services/get-all-services", [ProductsController::class, "getAll"]);
Route::get("/services/get-services-pagination", [ProductsController::class, "get"]);
Route::get("/services/get-services-search", [ProductsController::class, "search"]);
Route::get("/services/get-services-per-category-all", [ProductsController::class, "getProductsPerCategoryAll"]);
Route::get("/services/get-services-per-category-pagination", [ProductsController::class, "getProductsPerCategoryPagination"]);
Route::get("/services/get-service-by-id", [ProductsController::class, "getProduct"]);
Route::get("/services/get-most-selled", [ProductsController::class, "getMostSelled"]);
Route::get("/services/get-discounted", [ProductsController::class, "getDiscounted"]);
Route::get("/services/get-all-packages", [ProductsController::class, "getAllPackages"]);
Route::get("/services/get-packages-pagination", [ProductsController::class, "getPackages"]);
Route::get("/services/get-packages-search", [ProductsController::class, "searchPackages"]);

// Cart endpoints
Route::post("/cart/put-product", [CartController::class, "addProductToCart"])->middleware('auth:sanctum');
Route::post("/cart/remove-product", [CartController::class, "removeProductFromCart"])->middleware('auth:sanctum');
Route::post("/cart/update-product-quantity", [CartController::class, "updateProductQuantityAtCart"])->middleware('auth:sanctum');
Route::get("/cart/get", [CartController::class, "getCartDetails"])->middleware('auth:sanctum');

// Orders endpoints
Route::post("/orders/place", [OrdersController::class, "placeOrder"])->middleware('auth:sanctum');
Route::get("/orders/order/{id}", [OrdersController::class, "order"])->middleware('auth:sanctum');
Route::get("/orders/user/all", [OrdersController::class, "ordersAll"])->middleware('auth:sanctum');
Route::get("/orders/user/pagination", [OrdersController::class, "ordersPagination"])->middleware('auth:sanctum');
Route::get("/orders/user/search/all", [OrdersController::class, "searchOrdersAll"])->middleware('auth:sanctum');
Route::get("/orders/user/search/pagination", [OrdersController::class, "searchOrdersPagination"])->middleware('auth:sanctum');
Route::post("/orders/user/request/withdraw", [OrdersController::class, "requestMoney"])->middleware('auth:sanctum');
Route::get("/orders/user/request/withdraw/get", [OrdersController::class, "getRequests"])->middleware('auth:sanctum');

// Home endpoints
Route::get("/home/load-data", [HomeEndpoints::class, "getHomeApi"]);

// branches endpoints
Route::get("/branches/get", [BranchController::class, "getAllBranches"]);
Route::get("/branches/search", [BranchController::class, "searchBranches"]);

// cities endpoints
Route::get("/cities/get", [CityController::class, "get"]);

// regions endpoints
Route::get("/regions/get", [RegionController::class, "get"]);


