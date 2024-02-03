<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\HelperClasses\MessagesFlash;
use App\HelperClasses\MyApp;
use App\Http\Repositories\Interfaces\IAppointmentRepository;
use App\Http\Requests\AppointmentRequest;
use App\Services\AppointmentService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var \App\Http\Repositories\Interfaces\IAppointmentRepository
     */
    public $IAppointmentRepository;

    /**
     * @param  \App\Http\Repositories\Interfaces\IAppointmentRepository  $IAppointmentRepository
     */
    public function __construct(IAppointmentRepository $IAppointmentRepository)
    {
        $this->IAppointmentRepository = $IAppointmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function index()
    {
        $data = $this->IAppointmentRepository->get(false,function ($q){
            return $q->filter(\request()->input("filter")??[])->notExpired([]);
        });
        return $this->responseSuccess(null, compact("data"));
    }

    /**
     * @param $status
     * @param $appointment_id
     * @return mixed
     * @throws AuthorizationException
     */
    public function changeStatusAppointments($appointment_id,$status){
        $appointment = $this->IAppointmentRepository->find($appointment_id);
        if (!$appointment->canEdit()){
            throw new AuthorizationException();
        }
        $appointment->update([
            "status" => $status,
        ]);
        return $this->responseSuccess(null,null,MessagesFlash::Messages("default"));
    }

    /**
     * @param $appointment_id
     * @return mixed
     * @throws AuthorizationException
     */
    public function cancelAppointment($appointment_id){
        $appointment = $this->IAppointmentRepository->find($appointment_id);
        if (!$appointment->canCancel()){
            throw new AuthorizationException("This action is unauthorized. || Appointment status is not pending.");
        }
        $appointment->delete();
        return $this->responseSuccess(null,null,MessagesFlash::Messages("delete"));
    }

    /**
     * @param AppointmentRequest $request
     * @param AppointmentService $service
     * @return mixed
     * @throws MainException
     */
    public function bookingAppointmentDoctor(AppointmentRequest $request, AppointmentService $service){
        $data = $request->validated();
        if (!isset($data["user_id"])){
            $data["user_id"] = user()->id;
        }
        $data["date"] = MyApp::Classes()->stringProcess->DateFormat($data["date"]);
        $service->canBookingDoctor($data,$this->IAppointmentRepository);
        $result = $this->IAppointmentRepository->create($data);
        return $this->responseSuccess(null, compact("result"));
    }

}
