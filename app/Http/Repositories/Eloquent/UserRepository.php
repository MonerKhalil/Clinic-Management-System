<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    function queryModel()
    {
        return User::query();
    }

    public function preStoreBehaviour(array $data){
        $data['name'] = $data['first_name'] . " " . $data['last_name'];
        $data['password'] = Hash::make(User::PASSWORD);
        return $data;
    }

    public function postStoreBehaviour(Model $model, array $data){
        if (isset($data['role'])){
            $model->attachRole($data['role']);
        }
    }

    public function preUpdateBehaviour(Model $model, array $data){
        $data['name'] = $data['first_name'] . " " . $data['last_name'];
        return $data;
    }

    public function postUpdateBehaviour(Model $model, array $data){
        if (isset($data['role'])){
            $model->syncRoles([$data['role']]);
        }
    }
}
