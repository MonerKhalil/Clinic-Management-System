<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends BaseModel
{
    use HasFactory;

    const STATUS = ["pending","approve","reject"];

    protected $with = ["user","doctor"];

    protected $fillable = [
        "doctor_id","user_id","time","status",
        "is_active","created_by","updated_by","notes",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
