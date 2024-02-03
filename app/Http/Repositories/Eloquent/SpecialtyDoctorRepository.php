<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ISpecialtyDoctorRepository;
use App\Models\SpecialtyDoctor;

class SpecialtyDoctorRepository extends BaseRepository implements ISpecialtyDoctorRepository
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return SpecialtyDoctor::class;
    }

    /**
     * @inheritDoc
     */
    function queryModel()
    {
        return SpecialtyDoctor::query();
    }
}
