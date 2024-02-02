<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\Http\Repositories\Interfaces\IDoctorRepository;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * @var \App\Http\Repositories\Interfaces\IDoctorRepository
     */
    public $IDoctorRepository;

    /**
     * @param  \App\Http\Repositories\Interfaces\IDoctorRepository  $IDoctorRepository
     */
    public function __construct(IDoctorRepository $IDoctorRepository)
    {
        $this->IDoctorRepository = $IDoctorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function index()
    {
        $data = $this->IDoctorRepository->get();

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
    public function store(DoctorRequest $request)
    {
        $result = $this->IDoctorRepository->create($request->validated());

        return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function show(Doctor $doctor)
    {
        $dataShow = $this->IDoctorRepository->find($doctor->id);

        return $this->responseSuccess(null, compact("dataShow"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $data = $this->IDoctorRepository->find($doctor->id);

         return $this->responseSuccess(null, compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $result = $this->IDoctorRepository->update($request->validated() ,$doctor->id);

       return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function destroy(Doctor $doctor)
    {
        $result = $this->IDoctorRepository->delete($doctor->id);

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
       $result = $this->IDoctorRepository->active($id);

       return $this->responseSuccess();
    }

    /**
     * delete multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function multiDestroy(Request $request){
        $result = $this->IDoctorRepository->multiDestroy($request);

        return $this->responseSuccess();
    }
}
