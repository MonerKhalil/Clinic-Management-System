<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\HelperClasses\MyApp;
use App\Http\Repositories\Interfaces\IRoleRepository;
use App\Http\Repositories\Interfaces\IUserRepository;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @var IUserRepository
     */
    public $IUserRepository;

    /**
     * @var IRoleRepository
     */
    public $IRoleRepository;

    public function __construct(IUserRepository $IUserRepository,IRoleRepository $IRoleRepository)
    {
        $this->IUserRepository = $IUserRepository;
        $this->IRoleRepository = $IRoleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function index()
    {
        $data = $this->IUserRepository->get();

        return $this->responseSuccess(null, compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $roles = $this->IRoleRepository->all();

        return $this->responseSuccess(null, compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->IUserRepository->create($request->validated());
            $result->attachRole($request->role);
            DB::commit();
            return $this->responseSuccess(null,  compact("result"));
        }catch (\Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function show(User $user)
    {
        $dataShow = $this->IUserRepository->find($user->id);

        return $this->responseSuccess(null, compact("dataShow"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->IRoleRepository->all();

        $data = $this->IUserRepository->find($user->id);

        return $this->responseSuccess(null, compact("data","roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $result = $this->IUserRepository->update($request->validated() ,$user->id);
            $result->syncRoles($request->role);
            DB::commit();
            return $this->responseSuccess(null,  compact("result"));
        }catch (\Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function destroy(User $user)
    {
        $this->IUserRepository->delete($user->id);

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
       $result = $this->IUserRepository->active($id);

       return $this->responseSuccess();
    }

    /**
     * delete multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function multiDestroy(Request $request){
        $result = $this->IUserRepository->multiDestroy($request);

        return $this->responseSuccess();
    }

    public function resetPassword(Request $request){
        $request->validate([
            "ids" => ["required","array"],
            "ids.*" => ["required",Rule::exists("users","id")],
        ]);
        $this->IUserRepository->queryModelWithActive()->whereIn("id",$request->ids)
        ->update([
            "password" => Hash::make(User::PASSWORD),
        ]);
        return $this->responseSuccess(null, null, null, $this->indexPage);
    }

    ######################### PROFILE USER #########################

    public function showProfileUser(){
        $user = \user();
        return $this->responseSuccess(null,compact("user"));
    }

    public function editProfileUser(UserProfileRequest $request){
        $user = \user();

        $data = $request->validated();

        $result = $this->IUserRepository->update($data ,$user->id);

        return $this->responseSuccess(null,  compact("result"));
    }

}
