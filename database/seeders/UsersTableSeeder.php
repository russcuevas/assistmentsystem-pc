<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'default_id' => 1,
            'fullname' => 'Russel Vincent Cuevas',
            'email' => 'cuevasrussel0@gmail.com',
            'gender' => 'Male',
            'age' => '22',
            'birthday' => '12-26-2001',
            'strand' => 'HUMSS',
            'password' => Hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
