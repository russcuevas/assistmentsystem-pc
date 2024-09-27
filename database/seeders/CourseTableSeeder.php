<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'course_name' => 'Bachelor of Science in Information Technology',
            'course_description' => 'The Bachelor of Science in Information Technology (BSIT) program is a four-year degree program which focuses  on the study of computer utilization and computer software to plan, install, customize, operate, manage, administer and maintain information technology infrastructure.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
