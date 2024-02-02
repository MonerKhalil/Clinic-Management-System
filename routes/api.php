<?php

use App\HelperClasses\MyApp;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);

Route::middleware(["userCheckAuth","isActive","isVerify"])->group(function (){
    Route::prefix("auth")->group(function (){
        Route::delete('logout', [AuthController::class, 'logout']);
    });

    Route::prefix("profile")->controller(UserController::class)->group(function (){
        Route::get("show","showProfileUser");
        Route::post("edit","editProfileUser");
    });

    Route::middleware(["role:super_admin"])->group(function (){
        MyApp::Classes()->mainRoutes("user",UserController::class);
        Route::post("users/reset/password", [UserController::class, "resetPassword"]);
    });
});



