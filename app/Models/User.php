<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends BaseModel implements AuthenticatableContract,AuthorizableContract,CanResetPasswordContract
{
    use LaratrustUserTrait;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasApiTokens, HasFactory, Notifiable;

    public const PASSWORD = "123123123";

    protected $with = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','first_name','last_name',
        'role','is_active','created_by','updated_by',
        'token_reset_password_api',
        'email','email_verified_at',
        'password','token_reset_password_api'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password','pivot',
        'remember_token','token_reset_password_api',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function doctor(){
        return $this->hasOne(Doctor::class,"user_id","id");
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,"user_id");
    }

    public function isDoctor(){
        return !is_null($this->doctor()->first());
    }

    public function isAdmin(){
        return $this->role == "super_admin";
    }

    public function scopeNonDoctor($query){
        return $query->whereDoesntHave('doctor');
    }
}
