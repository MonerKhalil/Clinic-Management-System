<?php

namespace App\Services;

use App\Exceptions\MainException;
use App\Http\Repositories\Eloquent\UserRepository;
use App\Http\Repositories\Interfaces\IAppointmentRepository;
use Illuminate\Support\Arr;

class AppointmentService
{
    /**
     * @param $requestData
     * @param IAppointmentRepository $IAppointmentRepository
     * @throws MainException
     */
    public function canBookingDoctor($requestData, IAppointmentRepository $IAppointmentRepository){
        $arr_only = Arr::only($requestData,["doctor_id","date","time"]);
        $arr_only["status"] = "approve";
        $appointment = $IAppointmentRepository->queryModel()->where($arr_only)->exists();
        if ($appointment){
            throw new MainException("can not booking doctor => date and time is exists in doctor..");
        }
        $arr_only["status"] = "pending";
        $arr_only["user_id"] = $requestData["user_id"];
        $appointment = $IAppointmentRepository->queryModel()->where($arr_only)->exists();
        if ($appointment){
            throw new MainException("can not booking doctor => appointment is exists and is pending..");
        }
        $this->checkUserBookingIsDoctorCurrent($requestData["doctor_id"],$requestData["user_id"]);
    }

    /**
     * @param $doctor_id
     * @param $user_id
     * @throws MainException
     */
    private function checkUserBookingIsDoctorCurrent($doctor_id, $user_id){
        $user = (new UserRepository(app()));

        $user = $user->find($user_id,function ($q){
            return $q->with("doctor");
        },"id",false);

        if ($doctor_id == $user?->doctor?->id){
            throw new MainException("can not booking doctor => user current is doctor and = doctor_id");
        }
    }
}
