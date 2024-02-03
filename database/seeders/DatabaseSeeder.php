<?php

namespace Database\Seeders;

use App\Models\BaseModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(SpecialtyDoctorSeeder::class);
    }
}
