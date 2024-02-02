<?php

namespace App\Http\Requests;

use App\Models\Role;

class RoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $callback = (new Role)->validationBackEnd();

        return $callback($this);
    }
}
