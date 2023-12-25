<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return redirect("admin/login");
});

// AuthController
Route::get("admin/login", [AuthController::class, "index"])->name("admin.auth.index");
Route::post("admin/login", [AuthController::class, "login"])->name("admin.auth.login");

Route::group(["middleware" => "auth", "prefix" => "admin", "as" => "admin."], function () {
    // AuthController
    Route::get("logout", [AuthController::class, "logout"])->name("auth.logout");

    // DashboardController
    Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    // ProductController
    Route::resource("buses", BusController::class);

    // RouteController
    Route::resource("routes", RouteController::class);

    // TripController
    Route::resource("trips", TripController::class);

    // TicketController
    Route::resource("tickets", TicketController::class)->except(["edit", "delete", "store"]);
    Route::get("sub-route-ajax", [TicketController::class, "subRouteAjax"])->name("tickets.sub_route_ajax");
    Route::get("ticket-ajax", [TicketController::class, "ticketAjax"])->name("tickets.tickets_ajax");
    Route::post("ticket-create-ajax", [TicketController::class, "ticketCreateAjax"])->name("tickets.tickets_create_ajax");
});


