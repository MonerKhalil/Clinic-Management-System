<?php

namespace App\Http\Controllers;

use App\HelperClasses\MyApp;
use App\Http\Repositories\Interfaces\IUserRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct(private IUserRepository $IUserRepository)
    {
    }

    public function register(RegisterRequest $request){
        $data = [
            'name' => $request->first_name . " " . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = $this->IUserRepository->create($data);

        $token = $user->createToken($user->name,["*"])->plainTextToken;

        return $this->responseSuccess(null,[
            "user" => $user,
            "token" => $token,
        ]);
    }

    public function login(LoginRequest $request){
        $user = $this->IUserRepository->find($request->email,null,"email",false);
        if (is_null($user)){
            throw ValidationException::withMessages([
                'email/password' => __('auth.failed'),
            ]);
        }
        if (password_verify($request->password,$user->password)){
            $token = $user->createToken($user->name,["*"])->plainTextToken;
            return $this->responseSuccess(null,[
                "user" => $user,
                "token" => $token,
            ]);
        }
        else{
            throw ValidationException::withMessages([
                'email/password' => __('auth.failed'),
            ]);
        }
    }

    public function logout(){
        $user = user();
        $user->tokens()->delete();
        return $this->responseSuccess(null,null,"Successfully logged out");
    }
}
