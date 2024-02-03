<?php

namespace App\Models;

use App\HelperClasses\MyApp;
use App\Http\Requests\BaseRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Specialty extends BaseModel
{
    use HasFactory;

    protected $with = [];


    protected $fillable = [
        "name",
        "is_active","created_by","updated_by","notes",
    ];

    protected $hidden = ["pivot"];

    public function doctors(){
        return $this->belongsToMany(Doctor::class,"specialty_doctors");
    }
}
