<?php

namespace App\Models;

use App\HelperClasses\MyApp;
use App\Http\Requests\BaseRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Doctor extends BaseModel
{
    use HasFactory;

    protected $with = [];

    protected $fillable = [
        "user_id","name","address","phone",
        "is_active","created_by","updated_by","notes",
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function specialties(){
        return $this->belongsToMany(Specialty::class,"specialty_doctors");
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,"doctor_id");
    }

}
