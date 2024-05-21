<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin',
            'password' => Hash::make('123'),
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Company User
        User::create([
            'name' => 'Company User',
            'email' => 'company',
            'password' => Hash::make('123'),
            'user_type' => 'company',
            'email_verified_at' => now(),
        ]);

        // Job Seeker User
        User::create([
            'name' => 'Job Seeker User',
            'email' => 'jobseeker',
            'password' => Hash::make('123'),
            'user_type' => 'job_seeker',
            'email_verified_at' => now(),
        ]);
    }
}
