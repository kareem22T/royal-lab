<?php

use App\Http\Controllers\CompanyMsgsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\User\VisitsController;
use App\Http\Controllers\User\AppointmentsController;
use App\Http\Controllers\User\AppointmentServicesController;
use App\Http\Controllers\User\ConsultationController;
use App\Http\Controllers\User\TransactionsController;
use App\Http\Controllers\User\PrescriptionsController;
use App\Http\Controllers\User\HomeEndpoints;
use App\Http\Controllers\User\RegionController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\BranchController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\JobController;
use App\Http\Controllers\User\ResultsController;
use App\Http\Controllers\User\LiveHealthController;
use App\Http\Controllers\User\TeamsController;

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

// Visits endpoints
Route::post("/visits/place", [VisitsController::class, "placeVisit"])->middleware('auth:sanctum');
Route::get("/visits/visit/{id}", [VisitsController::class, "visit"])->middleware('auth:sanctum');
Route::get("/visits/user/all", [VisitsController::class, "visitsAll"])->middleware('auth:sanctum');
Route::get("/visits/user/pagination", [VisitsController::class, "visitsPagination"])->middleware('auth:sanctum');
Route::get("/visits/user/search/all", [VisitsController::class, "searchVisitsAll"])->middleware('auth:sanctum');
Route::get("/visits/user/search/pagination", [VisitsController::class, "searchVisitsPagination"])->middleware('auth:sanctum');
Route::post("/visits/user/request/withdraw", [VisitsController::class, "requestMoney"])->middleware('auth:sanctum');
Route::get("/visits/user/request/withdraw/get", [VisitsController::class, "getRequests"])->middleware('auth:sanctum');

// Appointments endpoints
Route::post("/appointments/place", [AppointmentsController::class, "placeAppointment"])->middleware('auth:sanctum');
Route::get("/appointments/appointment/{id}", [AppointmentsController::class, "appointment"])->middleware('auth:sanctum');
Route::get("/appointments/user/all", [AppointmentsController::class, "appointmentsAll"])->middleware('auth:sanctum');
Route::get("/appointments/user/pagination", [AppointmentsController::class, "appointmentsPagination"])->middleware('auth:sanctum');
Route::get("/appointments/user/search/all", [AppointmentsController::class, "searchAppointmentsAll"])->middleware('auth:sanctum');
Route::get("/appointments/user/search/pagination", [AppointmentsController::class, "searchAppointmentsPagination"])->middleware('auth:sanctum');
Route::post("/appointments/user/request/withdraw", [AppointmentsController::class, "requestMoney"])->middleware('auth:sanctum');
Route::get("/appointments/user/request/withdraw/get", [AppointmentsController::class, "getRequests"])->middleware('auth:sanctum');

// Medical_consultations endpoints
Route::post("/medical_consultations/place", [ConsultationController::class, "placeConsultation"])->middleware('auth:sanctum');
Route::get("/medical_consultations/medical_consultation/{id}", [ConsultationController::class, "medical_consultation"])->middleware('auth:sanctum');
Route::get("/medical_consultations/user/all", [ConsultationController::class, "medical_consultationsAll"])->middleware('auth:sanctum');
Route::get("/medical_consultations/user/pagination", [ConsultationController::class, "medical_consultationsPagination"])->middleware('auth:sanctum');
Route::get("/medical_consultations/user/search/all", [ConsultationController::class, "searchMedical_consultationsAll"])->middleware('auth:sanctum');
Route::get("/medical_consultations/user/search/pagination", [ConsultationController::class, "searchMedical_consultationsPagination"])->middleware('auth:sanctum');
Route::post("/medical_consultations/user/request/withdraw", [ConsultationController::class, "requestMoney"])->middleware('auth:sanctum');
Route::get("/medical_consultations/user/request/withdraw/get", [ConsultationController::class, "getRequests"])->middleware('auth:sanctum');
Route::get("/doctors/get", [ConsultationController::class, "getDoctors"]);
Route::get("/consultations/get", [ConsultationController::class, "getConsultation"]);

// Home endpoints
Route::get("/home/load-data", [HomeEndpoints::class, "getHomeApi"]);

// branches endpoints
Route::get("/branches/get", [BranchController::class, "getAllBranches"]);
Route::get("/branches/search", [BranchController::class, "searchBranches"]);

// cities endpoints
Route::get("/cities/get", [CityController::class, "get"]);

// regions endpoints
Route::get("/regions/get", [RegionController::class, "get"]);


// prescriptions endpoints
Route::post("/prescription/put", [PrescriptionsController::class, "store"])->middleware('auth:sanctum');
Route::post("/job/apply", [JobController::class, "store"]);


// results endpoints
Route::get("/user/results", [ResultsController::class, "get"])->middleware('auth:sanctum');
Route::get('/livehealth-results', [LiveHealthController::class, 'showResults'])->middleware('auth:sanctum');


// placeMsg endpoints
Route::post("/company/placeMsg", [CompanyMsgsController::class, "placeMsg"]);

// place comment endpoints
Route::post("/comment/put", [CommentController::class, "store"])->middleware('auth:sanctum');
Route::get("/comments/get", [CommentController::class, "get"]);

Route::get("/settings/get", [HomeEndpoints::class, 'settings']);
Route::get("/teams/get", [TeamsController::class, 'getAll']);
Route::get("/services-appointment/get", [AppointmentServicesController::class, 'get']);

