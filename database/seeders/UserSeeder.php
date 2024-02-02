<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'super_admin',
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@admin.com',
            'password' => Hash::make("123123123"),
            'role' => 'super_admin',
            'png_image' => null,
            'email_verified_at' => now(),
            'created_at' => now()
        ]);
        $user->attachRole($user->role);
    }
}
