<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\Http\Repositories\Interfaces\IAppointmentRepository;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
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
        $data = $this->IAppointmentRepository->get();

        return $this->responseSuccess(null, compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->responseSuccess();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function store(AppointmentRequest $request)
    {
        $result = $this->IAppointmentRepository->create($request->validated());

        return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function show(Appointment $appointment)
    {
        $dataShow = $this->IAppointmentRepository->find($appointment->id);

        return $this->responseSuccess(null, compact("dataShow"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $data = $this->IAppointmentRepository->find($appointment->id);

         return $this->responseSuccess(null, compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $result = $this->IAppointmentRepository->update($request->validated() ,$appointment->id);

       return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function destroy(Appointment $appointment)
    {
        $result = $this->IAppointmentRepository->delete($appointment->id);

        return $this->responseSuccess();
    }

    /**
     * active id Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function active($id)
    {
       $result = $this->IAppointmentRepository->active($id);

       return $this->responseSuccess();
    }

    /**
     * delete multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function multiDestroy(Request $request){
        $result = $this->IAppointmentRepository->multiDestroy($request);

        return $this->responseSuccess();
    }
}
