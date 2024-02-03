<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class AppointmentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = user();
        $today = Date::today()->format('Y-m-d');
        $RulesAll = [
            "doctor_id" => ["required",Rule::exists("doctors","id")],
            "date" => ["required", "date", "after_or_equal:" . $today],
            "time" => ["required","date_format:H:i"],
        ];
        if ($user->isAdmin()){
            $RulesAll["user_id"] = ["required",Rule::exists("users","id")];
        }
        return $RulesAll;
    }
}
