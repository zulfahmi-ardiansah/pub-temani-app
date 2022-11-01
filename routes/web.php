<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    MasterController,
    ReportController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root
    Route::any("/", function () { return redirect("/login"); });

// Auth
    Route::any("/login", [AuthController::class, "login"]);
    Route::any("/register", [AuthController::class, "register"]);
    Route::any("/logout", [AuthController::class, "logout"]);

// Logged User
    Route::middleware(["web", "web-auth"])->group(function () {
        
        // Home
            Route::prefix("/home")->group(function () {
                Route::get("/", [HomeController::class, "index"]);
                Route::any("/password", [HomeController::class, "password"]);
            });

        // Master
            Route::prefix("/master")->group(function () {
                Route::any("/category", [MasterController::class, "category"]);
                Route::any("/departement", [MasterController::class, "departement"]);
                Route::any("/employee", [MasterController::class, "employee"]);
                Route::any("/user", [MasterController::class, "user"]);
            });
            
        // Master
            Route::prefix("/report")->group(function () {
                Route::any("/history", [ReportController::class, "history"]);
                Route::any("/create", [ReportController::class, "create"]);
                Route::any("/list", [ReportController::class, "list"]);
                Route::any("/process/{id}", [ReportController::class, "process"]);
                Route::any("/view/{id}", [ReportController::class, "view"]);
                Route::any("/print/{id}", [ReportController::class, "print"]);
            });

    });