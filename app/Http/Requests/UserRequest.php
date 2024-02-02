<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $RulesAll = [
            'role' => 'required|exists:roles,name',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'image' => $this->imageRule(false),
        ];
        if ($this->isUpdatedRequest()){
            $RulesAll['email'] = 'required|email|unique:users,email,' . $this->user->id;
        }
        return $RulesAll;
    }
}
