<?php

namespace Database\Seeders;

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
        for ($i = 1; $i <= 100; $i++) {
            $year = rand(2024, 2026);
            $month = rand(1, 12);
            $day = rand(1, 28);

            $randomDate = \Carbon\Carbon::create($year, $month, $day);

            DB::table('users')->insert([
                'default_id' => $i,
                'fullname' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'gender' => $i % 2 == 0 ? 'Male' : 'Female',
                'age' => rand(18, 30),
                'birthday' => now()->subYears(rand(18, 30))->format('Y-m-d'),
                'strand' => 'HUMSS',
                'password' => Hash::make('123456789'),
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}
