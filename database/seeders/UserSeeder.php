<?php

namespace Database\Seeders;

use App\HelperClasses\MyApp;
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
            'password' => User::PASSWORD,
            'role' => 'super_admin',
            'image' => null,
            'email_verified_at' => now(),
            'created_at' => now()
        ]);
        $user->attachRole($user->role);
    }
}
