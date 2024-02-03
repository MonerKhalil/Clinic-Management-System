<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use SoftDeletes;

    public $guarded = [];

    const SUPER_ADMIN = "super_admin";
    const USER = "user";
}
