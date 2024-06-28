<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentsController;
use App\Http\Controllers\Admin\MoneyRequestsContrller;
use App\Http\Controllers\Admin\BacnnerController;
use App\Http\Middleware\GuestAdminMiddleware;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\OrdersController;

Route::prefix('admin')->group(function () {
    Route::post("login", [AuthController::class, "login"])->middleware([GuestAdminMiddleware::class])->name("admin.login.post");
    Route::get("login", [AuthController::class, "index"])->middleware([GuestAdminMiddleware::class]);

    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard
        Route::get("/dashboard", [DashboardController::class, "index"])->name("admin.dashboard");

        // Cities
        Route::prefix('cities')->group(function () {
            Route::get("/", [CityController::class, "index"])->name("admin.cities.show");
            Route::get("/get", [CityController::class, "get"])->name("admin.cities.get");
            Route::get("/create", [CityController::class, "add"])->name("admin.cities.add");
            Route::post("/create", [CityController::class, "create"])->name("admin.cities.create");
            Route::get("/edit/{id}", [CityController::class, "edit"])->name("admin.cities.edit");
            Route::post("/update", [CityController::class, "update"])->name("admin.cities.update");
            Route::get("/delete/{id}", [CityController::class, "deleteIndex"])->name("admin.cities.delete.confirm");
            Route::post("/delete", [CityController::class, "delete"])->name("admin.cities.delete");
        });

        // regions
        Route::prefix('regions')->group(function () {
            Route::get("/", [RegionController::class, "index"])->name("admin.regions.show");
            Route::get("/get", [RegionController::class, "get"])->name("admin.regions.get");
            Route::get("/create", [RegionController::class, "add"])->name("admin.regions.add");
            Route::post("/create", [RegionController::class, "create"])->name("admin.regions.create");
            Route::get("/edit/{id}", [RegionController::class, "edit"])->name("admin.regions.edit");
            Route::post("/update", [RegionController::class, "update"])->name("admin.regions.update");
            Route::get("/delete/{id}", [RegionController::class, "deleteIndex"])->name("admin.regions.delete.confirm");
            Route::post("/delete", [RegionController::class, "delete"])->name("admin.regions.delete");
        });

        // branches
        Route::prefix('branches')->group(function () {
            Route::get("/", [BranchController::class, "index"])->name("admin.branches.show");
            Route::get("/get", [BranchController::class, "get"])->name("admin.branches.get");
            Route::get("/create", [BranchController::class, "add"])->name("admin.branches.add");
            Route::post("/create", [BranchController::class, "create"])->name("admin.branches.create");
            Route::get("/edit/{id}", [BranchController::class, "edit"])->name("admin.branches.edit");
            Route::post("/update", [BranchController::class, "update"])->name("admin.branches.update");
            Route::get("/delete/{id}", [BranchController::class, "deleteIndex"])->name("admin.branches.delete.confirm");
            Route::post("/delete", [BranchController::class, "delete"])->name("admin.branches.delete");
        });

        // Products
        Route::prefix('products')->group(function () {
            Route::get("/", [ProductsController::class, "index"])->name("admin.products.show");
            Route::get("/toggle-disc/{id}", [ProductsController::class, "toggleProductDiscounted"])->name("admin.products.toggleDis");
            Route::get("/get", [ProductsController::class, "get"])->name("admin.products.get");
            Route::get("/create", [ProductsController::class, "add"])->name("admin.products.add");
            Route::post("/create", [ProductsController::class, "create"])->name("admin.products.create");
            Route::get("/edit/{id}", [ProductsController::class, "edit"])->name("admin.products.edit");
            Route::post("/update", [ProductsController::class, "update"])->name("admin.products.update");
            Route::get("/delete/{id}", [ProductsController::class, "deleteIndex"])->name("admin.products.delete.confirm");
            Route::post("/delete", [ProductsController::class, "delete"])->name("admin.products.delete");
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get("/order/{id}", [OrdersController::class, "order"])->name("admin.orders.order.details");
            Route::get("/all", [OrdersController::class, "index"])->name("admin.orders.show.all");
            Route::get("/review", [OrdersController::class, "indexReview"])->name("admin.orders.show.review");
            Route::get("/confirmed", [OrdersController::class, "indexConfirmed"])->name("admin.orders.show.confirmed");
            Route::get("/delivary", [OrdersController::class, "indexDelivary"])->name("admin.orders.show.delivary");
            Route::get("/completed", [OrdersController::class, "indexCompleted"])->name("admin.orders.show.completed");
            Route::get("/canceled", [OrdersController::class, "indexCanceled"])->name("admin.orders.show.canceled");

            Route::get("/order/approve/{id}", [OrdersController::class, "approveIndex"])->name("admin.orders.approve");
            Route::post("/order/approve/confirm/{id}", [OrdersController::class, "approve"])->name("admin.orders.approve.post");
            Route::get("/order/cancel/{id}", [OrdersController::class, "cancelIndex"])->name("admin.orders.cancel");
            Route::post("/order/cancel/confirm/{id}", [OrdersController::class, "cancel"])->name("admin.orders.cancel.post");
            Route::get("/order/success/{id}", [OrdersController::class, "successIndex"])->name("admin.orders.success");
        });

        // Appointments
        Route::prefix('appointments')->group(function () {
            Route::get("/appointment/{id}", [AppointmentsController::class, "appointment"])->name("admin.appointments.appointment.details");
            Route::get("/all", [AppointmentsController::class, "index"])->name("admin.appointments.show.all");
            Route::get("/review", [AppointmentsController::class, "indexReview"])->name("admin.appointments.show.review");
            Route::get("/confirmed", [AppointmentsController::class, "indexConfirmed"])->name("admin.appointments.show.confirmed");
            Route::get("/delivary", [AppointmentsController::class, "indexDelivary"])->name("admin.appointments.show.delivary");
            Route::get("/completed", [AppointmentsController::class, "indexCompleted"])->name("admin.appointments.show.completed");
            Route::get("/canceled", [AppointmentsController::class, "indexCanceled"])->name("admin.appointments.show.canceled");

            Route::get("/appointment/approve/{id}", [AppointmentsController::class, "approveIndex"])->name("admin.appointments.approve");
            Route::post("/appointment/approve/confirm/{id}", [AppointmentsController::class, "approve"])->name("admin.appointments.approve.post");
            Route::get("/appointment/cancel/{id}", [AppointmentsController::class, "cancelIndex"])->name("admin.appointments.cancel");
            Route::post("/appointment/cancel/confirm/{id}", [AppointmentsController::class, "cancel"])->name("admin.appointments.cancel.post");
            Route::get("/appointment/success/{id}", [AppointmentsController::class, "successIndex"])->name("admin.appointments.success");
        });
    });
});
