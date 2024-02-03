<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = [
            [
            'name' => 'doctor_temp',
            'first_name' => 'doctor',
            'last_name' => 'temp',
            'email' => 'doctor_tem@doctor.com',
            'password' => User::PASSWORD,
            'role' => 'doctor',
            'image' => null,
            'email_verified_at' => now(),
            'created_at' => now()
            ],
            [
                'name' => 'doctor_temp1',
                'first_name' => 'doctor',
                'last_name' => 'temp1',
                'email' => 'doctor_tem1@doctor.com',
                'password' => User::PASSWORD,
                'role' => 'doctor',
                'image' => null,
                'email_verified_at' => now(),
                'created_at' => now()
            ]
        ];
        foreach ($doctors as $user){
            $user = User::create($user);
            $user->attachRole($user->role);
            Doctor::create([
                "user_id" => $user->id,
                "name" => $user->name,
                "address" => Str::random(16),
                "phone" => random_int(1111111111,9999999999),
            ]);
        }
    }
}
