<?php

namespace Database\Seeders;

use App\Models\SpecialtyDoctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtyDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1 ; $i<=10 ; $i++){
            $data = [];
            $data["specialty_id"] = $i;
            if ($i<=5){
                $data["doctor_id"] = 1;
            }else{
                $data["doctor_id"] = 2;
            }
            SpecialtyDoctor::create($data);
        }
    }
}
