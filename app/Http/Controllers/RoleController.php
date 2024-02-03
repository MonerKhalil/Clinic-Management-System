<?php

namespace App\Http\Controllers;

use App\Exceptions\MainException;
use App\HelperClasses\MyApp;
use App\Http\Repositories\Interfaces\IRoleRepository;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * @var \App\Http\Repositories\Interfaces\IRoleRepository
     */
    public $IRoleRepository;

    /**
     * @param  \App\Http\Repositories\Interfaces\IRoleRepository  $IRoleRepository
     */
    public function __construct(IRoleRepository $IRoleRepository)
    {
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
        try {
            $data = $this->IRoleRepository->get();

            return $this->responseSuccess($this->indexView, compact("data"));

        } catch (\Exception $e) {
          throw new MainException($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $tables = MyApp::Classes()->laratrustFileSeeder->getAllNameTables();

            $permissions = Permission::query()->get(["id","name"]);

            $finalData = MyApp::Classes()->laratrustFileSeeder->FinalPermissionsData($permissions,$tables);

            return $this->responseSuccess($this->createView, compact("finalData"));

        } catch (\Exception $e) {
            throw new MainException($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataRole = Arr::except($request->validated(),["permissions"]);
            $permissions = $request->permissions ?? [];
            $role = $this->IRoleRepository->create($dataRole);
            $role->syncPermissions($permissions);
            MyApp::Classes()->laratrustFileSeeder->MainProcess($role,$permissions);
            DB::commit();
            return $this->responseSuccess(null, compact("role"), null, $this->indexPage);

        } catch (\Exception $e) {
          throw new MainException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function show(Role $role)
    {
        try {
           $dataShow = $this->IRoleRepository->find($role->id);

           return $this->responseSuccess($this->indexView, compact("dataShow"));

        } catch (\Exception $e) {
          throw new MainException($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        try {
            $tables = MyApp::Classes()->laratrustFileSeeder->getAllNameTables();

            $permissions = Permission::query()->get(["id","name"]);

            $rolePermissions = $role->permissions()->pluck('id', 'id')->toArray();

            $finalData = MyApp::Classes()->laratrustFileSeeder->FinalPermissionsData($permissions,$tables);

            return $this->responseSuccess($this->updateView, compact("finalData",'rolePermissions','tables','role'));

        } catch (\Exception $e) {
            throw new MainException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function update(RoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $dataRole = Arr::except($request->validated(),["permissions"]);
            $permissions = $request->permissions ?? [];
            $role = $this->IRoleRepository->update($dataRole,$role->id);
            $role->syncPermissions($permissions);
            MyApp::Classes()->laratrustFileSeeder->MainProcess($role,$permissions);
            DB::commit();
            return $this->responseSuccess(null, compact("role"), null, $this->indexPage);

        } catch (\Exception $e) {
          throw new MainException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function destroy(Role $role)
    {
        try {
           $result = $this->IRoleRepository->delete($role->id);

           return $this->responseSuccess(null, null, null, $this->indexPage);

        } catch (\Exception $e) {
          throw new MainException($e->getMessage());
        }
    }

    /**
     * active multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function active($id)
    {
       $result = $this->IRoleRepository->active($id);

       return $this->responseSuccess(null, null, null, $this->indexPage);
    }

    /**
     * delete multi ids Records Table.
     *
     * @return \Illuminate\Http\Response
     * @author moner khalil
     */
    public function multiDestroy(Request $request){
        $result = $this->IRoleRepository->multiDestroy($request);

        return $this->responseSuccess(null, null, null, $this->indexPage);
    }
}
