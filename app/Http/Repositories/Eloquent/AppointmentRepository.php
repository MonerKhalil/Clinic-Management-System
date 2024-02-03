<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\IAppointmentRepository;
use App\Models\Appointment;

class AppointmentRepository extends BaseRepository implements IAppointmentRepository
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return Appointment::class;
    }

    /**
     * @inheritDoc
     */
    function queryModel()
    {
        return Appointment::query();
    }
}
