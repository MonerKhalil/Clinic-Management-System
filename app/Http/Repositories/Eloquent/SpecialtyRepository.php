<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ISpecialtyRepository;
use App\Models\Specialty;

class SpecialtyRepository extends BaseRepository implements ISpecialtyRepository
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return Specialty::class;
    }

    /**
     * @inheritDoc
     */
    function queryModel()
    {
        return Specialty::query();
    }
}
