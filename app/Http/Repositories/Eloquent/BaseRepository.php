<?php

namespace App\Http\Repositories\Eloquent;

use App\Exceptions\MainException;
use App\HelperClasses\MessagesFlash;
use App\HelperClasses\MyApp;
use App\Http\Repositories\Interfaces\IBaseRepository;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseRepository implements IBaseRepository
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var string
     */
    public string $nameTable = "";

    /**
     * @var
     */
    public $model;

    public abstract function model();

    public abstract function queryModel();

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->nameTable = $this->queryModel()->getQuery()->from;
    }

    public function getInstance()
    {
        return new $this->model;
    }

    public function makeModel(){
        try {
            $model = $this->app->make($this->model());
            return $this->model = $model;
        } catch (Exception $e) {
            throw new MainException($e->getMessage());
        }
    }

    public function queryModelWithActive(){
        $query = $this->queryModel();
        $is_active = isset(request()->filter) && is_array(request()->filter) && isset(request()->filter["is_active"]);
        $is_exist = Schema::hasColumn($this->nameTable, "is_active");
        if (user()?->role == "super_admin" && $is_exist && $is_active){
            $query = $query->where($this->nameTable.".is_active",request()->filter["is_active"]);
        }elseif($is_exist){
            $query = $query->where($this->nameTable.".is_active",true);
        }
        return $query;
    }

    /**
     * without search filter data
     * @param callable|null $callback
     * @param bool $withActive
     * @author moner khalil
     */
    public function all(callable $callback = null,bool $withActive = true,$order = "desc",$columnOrder = null)
    {
        $queryBuilder = $withActive ? $this->queryModelWithActive() : $this->queryModel();
        if (!is_null($callback)){
            $queryBuilder =  $callback($queryBuilder);
        }
        return $queryBuilder->orderBy($columnOrder ?? "updated_at",$order)->get();
    }

    /**
     * within search filter data
     * @param bool|null $isAll
     * @param callable|null $callback
     * @author moner khalil
     */
    public function get(bool $isAll = null, callable $callback = null,bool $withActive = true,?string $nameDateFilter = null)
    {
        $queryBuilder = $withActive ? $this->queryModelWithActive() : $this->queryModel();
        return MyApp::Classes()->Search
            ->getDataFilter($queryBuilder,null,$isAll,$nameDateFilter,$callback,$this->nameTable,$this->model);
    }

    /**
     * @param $data
     * @param bool $showMessage
     * @return mixed
     * @throws MainException
     * @author moner khalil
     */
    public function create($data , bool $showMessage = true): mixed{
        try {
            DB::beginTransaction();
            $process = "create";
            $item = $this->queryModel()->create($data);
            MyApp::Classes()->logMain->logProcess($process,$item);
            if ($showMessage){
                MessagesFlash::Success($process);
            }
            DB::commit();
            return $item;
        }catch (Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * @param $data
     * @param int $idOldModel
     * @param bool $showMessage
     * @return mixed
     * @throws MainException
     * @author moner khalil
     */
    public function update($data,int $idOldModel, bool $showMessage = true): mixed{
        try {
            DB::beginTransaction();
            $process = "update";
            $oldModel = $this->find($idOldModel);
            $oldModel->update($data);
            MyApp::Classes()->logMain->logProcess($process,$oldModel);
            if ($showMessage){
                MessagesFlash::Success($process);
            }
            $newModel = $this->find($idOldModel);
            DB::commit();
            return $newModel;
        }catch (Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * @param $value
     * @param callable|null $callback
     * @param string $key
     * @param bool $withFail
     * @param bool $withActive
     * @return mixed
     * @author moner khalil
     */
    public function find($value, callable $callback = null, string $key = "id",bool $withFail = true,bool $withActive = true): mixed{
        $query = $withActive ? $this->queryModelWithActive() : $this->queryModel();
        $query = $query->where($key,$value);
        if (!is_null($callback)){
            $query = $callback($query);
        }
        return $withFail ? $query->firstOrFail() : $query->first();
    }

    /**
     * @param int $idModel
     * @param bool $showMessage
     * @return mixed
     * @throws MainException
     * @author moner khalil
     */
    public function delete(int $idModel, bool $showMessage = true): bool{
        try {
            DB::beginTransaction();
            $process = "delete";
            $oldModel = $this->find($idModel);
            $oldModel->delete();
            MyApp::Classes()->logMain->logProcess($process,$oldModel);
            if ($showMessage){
                MessagesFlash::Success($process);
            }
            DB::commit();
            return true;
        }catch (Exception $exception){
            DB::rollBack();
            if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException){
                throw new ModelNotFoundException();
            }
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * @param $request
     * @param bool $showMessage
     * @param null $callbackWhere
     * @return mixed
     * @throws MainException
     * @author moner khalil
     */
    public function multiDestroy($request, bool $showMessage = true,$callbackWhere = null): bool{
        $request->validate([
            "ids" => ["required","array"],
            "ids.*" => ["required",Rule::exists($this->nameTable,"id")],
        ]);
        try {
            DB::beginTransaction();
            $process = "delete";
            $oldModel = $this->queryModel()->whereIn("id",$request->ids);
            if (!is_null($callbackWhere)){
                $oldModel = $callbackWhere($oldModel);
            }
            $oldModel->delete();
            MyApp::Classes()->logMain->logProcess($process,["table"=>$this->nameTable]);
            if ($showMessage){
                MessagesFlash::Success($process);
            }
            DB::commit();
            return true;
        }catch (Exception $exception){
            DB::rollBack();
            throw new MainException($exception->getMessage());
        }
    }

    /**
     * @param int $idModel
     * @param bool $showMessage
     * @return bool
     * @throws MainException
     * @author moner khalil
     */
    public function active(int $idModel , bool $showMessage = true): bool
    {
        try {
            $process = "update";
            $oldModel = $this->find($idModel,null,"id",true,false);
            $oldModel->update(['is_active' => !$oldModel->is_active,]);
            MyApp::Classes()->logMain->logProcess($process,$oldModel);
            if ($showMessage){
                MessagesFlash::Success($process);
            }
            return true;
        }catch (Exception $e){
            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException){
                throw new ModelNotFoundException();
            }
            throw new MainException($e->getMessage());
        }
    }
}
