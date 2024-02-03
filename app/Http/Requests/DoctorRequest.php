<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class DoctorRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ["required",Rule::exists("users","id")->where("role","doctor")],
            "name" => $this->textRule(true),
            "address" => $this->editorRule(true),
            "phone" => ["required","integer","digits:10"],
            "specialties_ids" => ["required","array"],
            "specialties_ids.*" => ["required",Rule::exists("specialties","id")],
        ];
    }
}
