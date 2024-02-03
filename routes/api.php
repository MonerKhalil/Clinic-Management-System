<?php

use App\HelperClasses\MyApp;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);

Route::middleware(["userCheckAuth"])->group(function (){
    Route::prefix("auth")->group(function (){
        Route::delete('logout', [AuthController::class, 'logout']);
    });

    Route::prefix("profile")->controller(UserController::class)->group(function (){
        Route::get("show","showProfileUser");
        Route::post("edit","editProfileUser");
    });

    Route::middleware(["role_user:super_admin"])->group(function (){
        #USER
        MyApp::Classes()->mainRoutes("user",UserController::class);
        Route::post("users/reset/password", [UserController::class, "resetPassword"]);
        #end

        #DOCTOR
        MyApp::Classes()->mainRoutes("doctor", DoctorController::class);
        #end

        #Specialty
        MyApp::Classes()->mainRoutes("specialty", SpecialtyController::class);
        #end
    });

    Route::middleware(["role_user:doctor|super_admin"])->controller(AppointmentController::class)->group(function (){
        Route::get("show/all/appointments","index");
        Route::post("change/status/{status}","changeStatusAppointments");
    });

    Route::controller(AppointmentController::class)->group(function (){
        Route::post("booking/appointment/doctor/{doctor_id}","bookingAppointmentDoctor");
        Route::post("cancel/appointment/{appointment_id}","cancelAppointment");
    });
});



