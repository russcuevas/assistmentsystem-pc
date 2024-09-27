<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferredCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('preferred_courses')->insert([
            'user_id' => 1,
            'course_1' => 1,
            'course_2' => 2,
            'course_3' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
