<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SpecialtyRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isUpdatedRequest()){
            $specialty = $this->route("specialty")?->id ?? "";
            return [
                "name" => ["required",Rule::unique("specialties","name")->ignore($specialty,"id")],
            ];
        }
        return [
            "name" => ["required",Rule::unique("specialties","name")],
        ];
    }
}
