<?php

namespace App\Models;

use App\HelperClasses\MyApp;
use App\Http\Requests\BaseRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class SpecialtyDoctor extends BaseModel
{
    use HasFactory;

    protected $with = [];


    protected $fillable = [
        "specialty_id","doctor_id",
        "is_active","created_by","updated_by","notes",
    ];
}
