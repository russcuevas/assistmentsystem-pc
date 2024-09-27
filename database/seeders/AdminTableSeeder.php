<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'profile_picture' => null, // Set profile_picture to null
            'fullname' => 'Admin User',
            'email' => 'russelcuevas0@gmail.com',
            'password' => Hash::make('123456789'), // Use a hashed password
            'created_at' => now(), // Optionally add timestamps
            'updated_at' => now(),
        ]);
    }
}
