<?php

namespace App\Http\Requests;

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
        $RulesAll = [
            "doctor_id" => ["required",Rule::exists("doctors","id")],
            "date" => ["required","date"],
            "time" => ["required",""]
        ];
        if ($user->isAdmin()){
            $RulesAll["user_id"] = ["required",Rule::exists("users","id")];
        }
        return $RulesAll;
    }
}
