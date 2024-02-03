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
        return $this->belongsToMany(Specialty::class,"specialty_doctors")->withTimestamps();
    }

    public function specialties_pivot(){
        return $this->hasMany(SpecialtyDoctor::class,"doctor_id");
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,"doctor_id");
    }

    public function scopeFilter($q,$filters){
        $checkCanFilterInSpecialty = isset($filters["specialty_name"]) && !is_null($filters["specialty_name"]);
        $checkCanFilterInSpecialtyID = isset($filters["specialty_ids"]) && is_array($filters["specialty_ids"]);
        return $q->when($checkCanFilterInSpecialty||$checkCanFilterInSpecialtyID,
            function ($q_specialty)use($filters,$checkCanFilterInSpecialty,$checkCanFilterInSpecialtyID){
                if ($checkCanFilterInSpecialty){
                    $q_specialty = $q_specialty->whereHas("specialties",function ($q)use($filters){
                        return $q->where("name","LIKE",$filters['specialty_name']."%");
                    });
                }
                if ($checkCanFilterInSpecialtyID){
                    $q_specialty = $q_specialty->whereHas("specialties_pivot",function ($q)use($filters){
                        return $q->whereIn("id",$filters["specialty_ids"]);
                    });
                }
                return $q_specialty;
        });
    }

}
