<?php

use App\HelperClasses\MyApp;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

#Can Be Filter in any route get index in any tables
#send filter in query params => filter is array === ["key1" => "value1","key2" => "value2",]
#example1 in users table  => filter[name] = "xxx" & filter[first_name] = "xxx"
#example2 in appointments table => filter[status] = "pending"

#table doctors and appointments => added default search filter attributes in model in (function scopeFilter())

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);

Route::middleware(["userCheckAuth"])->group(function (){
    Route::prefix("auth")->group(function (){
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::prefix("profile")->controller(UserController::class)->group(function (){
            Route::get("show","showProfileUser");
            Route::put("edit","editProfileUser");
        });
    });

    Route::middleware(["role_user:super_admin"])->group(function (){
        #USER
        MyApp::Classes()->mainRoutes("user",UserController::class);
        Route::post("users/reset/password", [UserController::class, "resetPassword"]);
        #end
    });

    #DOCTOR
    MyApp::Classes()->mainRoutes("doctor", DoctorController::class);
    #end

    #Specialty
    MyApp::Classes()->mainRoutes("specialty", SpecialtyController::class);
    #end

    Route::controller(AppointmentController::class)->group(function (){
        #can use route ( all roles )
        Route::get("show/all/appointments","index");

        Route::post("change/appointment/{appointment_id}/status/{status}","changeStatusAppointments")
            ->whereIn("status", ["pending","approve","reject",]);
        Route::post("booking/appointment/doctor","bookingAppointmentDoctor");
        Route::post("cancel/appointment/{appointment_id}","cancelAppointment");
    });
});



