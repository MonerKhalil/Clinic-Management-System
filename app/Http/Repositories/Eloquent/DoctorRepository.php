<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\IDoctorRepository;
use App\Models\Doctor;

class DoctorRepository extends BaseRepository implements IDoctorRepository
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return Doctor::class;
    }

    /**
     * @inheritDoc
     */
    function queryModel()
    {
        return Doctor::query();
    }
}
