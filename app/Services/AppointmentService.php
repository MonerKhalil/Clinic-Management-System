<?php

namespace App\Services;

use App\Exceptions\MainException;
use App\Http\Repositories\Interfaces\IAppointmentRepository;
use Illuminate\Support\Arr;

class AppointmentService
{
    public function canBookingDoctor($requestData,IAppointmentRepository $IAppointmentRepository){
        $arr_only = Arr::only($requestData,["user_id","doctor_id","date","time"]);
        $appointment = $IAppointmentRepository->queryModel()->where($arr_only)->exists();
        if ($appointment){
            throw new MainException("can not booking doctor => date and time is exists in doctor..");
        }
    }
}
