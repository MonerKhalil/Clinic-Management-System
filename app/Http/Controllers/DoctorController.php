<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\Http\Repositories\Interfaces\IDoctorRepository;
use App\Http\Repositories\Interfaces\ISpecialtyRepository;
use App\Http\Repositories\Interfaces\IUserRepository;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * @var \App\Http\Repositories\Interfaces\IDoctorRepository
     */
    public $IDoctorRepository;

    /**
     * @var \App\Http\Repositories\Interfaces\IUserRepository
     */
    public $IUserRepository;

    /**
     * @var \App\Http\Repositories\Interfaces\ISpecialtyRepository
     */
    public $ISpecialtyRepository;


    public function __construct(IDoctorRepository $IDoctorRepository,ISpecialtyRepository $ISpecialtyRepository,
                                IUserRepository $IUserRepository)
    {
        $this->IDoctorRepository = $IDoctorRepository;
        $this->IUserRepository = $IUserRepository;
        $this->ISpecialtyRepository = $ISpecialtyRepository;
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
        $specialties = $this->ISpecialtyRepository->all();

        $users = $this->IUserRepository->all();

        return $this->responseSuccess(null,compact("users","specialties"));
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
        if (is_null($this->IUserRepository->find($request->user_id,null,"user_id",false))){
            try {
                DB::beginTransaction();
                $result = $this->IDoctorRepository->create(Arr::except($request->validated(),["specialties_ids"]));
                $result->specialties()->attach($request->specialties_ids);
                DB::commit();
                return $this->responseSuccess(null, compact("result"));
            }catch (\Exception $exception){
                DB::rollBack();
                throw new MainException($exception->getMessage());
            }
        }
        throw new MainException("the user_id is doctor....");
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
        try {
            DB::beginTransaction();
            $result = $this->IDoctorRepository->update(Arr::except($request->validated(),["specialties_ids"]) ,$doctor->id);
            $doctor->specialties()->sync($result->specialties_ids);
            DB::commit();
            return $this->responseSuccess(null, compact("result"));
        }catch (\Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
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
