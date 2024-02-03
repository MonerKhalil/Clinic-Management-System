<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\Http\Repositories\Interfaces\ISpecialtyRepository;
use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * @var \App\Http\Repositories\Interfaces\ISpecialtyRepository
     */
    public $ISpecialtyRepository;

    /**
     * @var \App\Http\Repositories\Interfaces\IDoctorRepository
     */
    public $IDoctorRepository;

    public function __construct(ISpecialtyRepository $ISpecialtyRepository)
    {
        $this->ISpecialtyRepository = $ISpecialtyRepository;
        $this->middleware("role_user:super_admin")->except(["index","show"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function index()
    {
        $data = $this->ISpecialtyRepository->get();

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
    public function store(SpecialtyRequest $request)
    {
        $result = $this->ISpecialtyRepository->create($request->validated());

        return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function show(Specialty $specialty)
    {
        $dataShow = $this->ISpecialtyRepository->find($specialty->id);

        $doctors = $this->IDoctorRepository->get(false,function ($q)use($dataShow){
            return $q->whereHas("specialties_pivot",function ($q)use($dataShow){
                $q->where("specialty_id",$dataShow->id);
            });
        });

        return $this->responseSuccess(null, compact("dataShow","doctors"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        $data = $this->ISpecialtyRepository->find($specialty->id);

         return $this->responseSuccess(null, compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function update(SpecialtyRequest $request, Specialty $specialty)
    {
        $result = $this->ISpecialtyRepository->update($request->validated() ,$specialty->id);

       return $this->responseSuccess(null, compact("result"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function destroy(Specialty $specialty)
    {
        $result = $this->ISpecialtyRepository->delete($specialty->id);

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
       $result = $this->ISpecialtyRepository->active($id);

       return $this->responseSuccess();
    }

    /**
     * delete multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function multiDestroy(Request $request){
        $result = $this->ISpecialtyRepository->multiDestroy($request);

        return $this->responseSuccess();
    }
}
