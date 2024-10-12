<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferredCourseTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('preferred_courses')->insert([
                'user_id' => $i,
                'course_1' => rand(1, 5),
                'course_2' => rand(1, 5),
                'course_3' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
