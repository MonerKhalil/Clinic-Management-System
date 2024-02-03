<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends BaseModel
{
    use HasFactory;

    const STATUS = ["pending","approve","reject"];

    protected $with = ["user","doctor"];

    protected $fillable = [
        "doctor_id","user_id","date","time","status",
        "is_active","created_by","updated_by","notes",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function isPending(){
        return $this->status == "pending";
    }

    public function canEdit(){
        $user = user();
        return $user->isAdmin() || $this->doctor_id == $user?->doctor?->id;
    }

    public function canCancel(){
        $user = user();
        return $this->canEdit() || ($this->isPending() && $this->user_id == $user->id);
    }

    public function scopeFilter($q,$filters){
        $user = user();
        $checkCanFilterInUser = isset($filters["user_name"]) && !is_null($filters["user_name"]);
        $checkCanFilterInDoctor = isset($filters["doctor_name"]) && !is_null($filters["doctor_name"]);
        $checkCanFilterInSpecialty = isset($filters["specialty_name"]) && !is_null($filters["specialty_name"]);
        $checkCanFilterInSpecialtyID = isset($filters["specialty_ids"]) && is_array($filters["specialty_ids"]);

        return $q->when(!$user->isAdmin() && !$user->isDoctor(),function ($q,$user){
            return $q->where("user_id",$user->id);
        })->when(!$user->isAdmin() && $user->isDoctor(),function ($q)use($user){
            return $q->where("doctor_id",$user->doctor->id);
        })->when($checkCanFilterInUser&&$user->isAdmin() ,function ($q_user)use($filters){
            return $q_user->whereHas("user",function ($q)use($filters){
                return $q->where("name","LIKE",$filters["user_name"]."%");
            });
        })->when($checkCanFilterInDoctor||$checkCanFilterInSpecialty||$checkCanFilterInSpecialtyID,
            function ($q_specialty)use($filters,$checkCanFilterInDoctor,$checkCanFilterInSpecialty,$checkCanFilterInSpecialtyID){
                return $q_specialty->whereHas("doctor",function ($q_doctor) use ($filters,$checkCanFilterInDoctor,$checkCanFilterInSpecialty,$checkCanFilterInSpecialtyID){
                    if ($checkCanFilterInDoctor){
                        $q_doctor = $q_doctor->where("name","LIKE",$filters['doctor_name']."%");
                    }
                    if ($checkCanFilterInSpecialty){
                        $q_doctor = $q_doctor->whereHas("specialties",function ($q)use($filters){
                            return $q->where("name","LIKE",$filters['specialty_name']."%");
                        });
                    }
                    if ($checkCanFilterInSpecialtyID){
                        $q_doctor = $q_doctor->whereHas("specialties_pivot",function ($q)use($filters){
                            return $q->whereIn("id",$filters["specialty_ids"]);
                        });
                    }
                    return $q_doctor;
            });
        });
    }
}
