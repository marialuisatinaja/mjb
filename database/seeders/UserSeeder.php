<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'first_name' => 'Test User',
            'email' => 'test@example.com',
            'user_type' => 'Admin',
            'password' => bcrypt('password'),
            'status' => 'Active',
        ]);

        User::firstOrCreate([
            'first_name' => 'Aljun',
            'last_name' => 'Naraga',
            'gender' => 'male',
            'email' => 'aljun@gmail.com',
            'user_type' => 'Therapist',
            'password' => bcrypt('password'),
            'status' => 'Active',
        ]);

        User::firstOrCreate([
            'first_name' => 'Alvin',
            'last_name' => 'Tandugon',
            'gender' => 'male',
            'email' => 'alvin@gmail.com',
            'user_type' => 'Therapist',
            'password' => bcrypt('password'),
            'status' => 'Active',
        ]);

        
        User::firstOrCreate([
            'first_name' => 'Pamie',
            'last_name' => 'Ampo',
            'gender' => 'female',
            'email' => 'pamie@gmail.com',
            'user_type' => 'Therapist',
            'password' => bcrypt('password'),
            'status' => 'Active',
        ]);

        User::firstOrCreate([
            'first_name' => 'Elma',
            'last_name' => 'Gelicame',
            'gender' => 'female',
            'email' => 'elma@gmail.com',
            'user_type' => 'Therapist',
            'password' => bcrypt('password'),
            'status' => 'Active',
        ]);
    }
}
