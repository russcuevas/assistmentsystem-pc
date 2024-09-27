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
            [
                'course_name' => 'Bachelor of Science in Information Technology',
                'course_description' => 'The Bachelor of Science in Information Technology (BSIT) program is a four-year degree program which focuses on the study of computer utilization and computer software to plan, install, customize, operate, manage, administer and maintain information technology infrastructure.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Bachelor of Science in Accountancy',
                'course_description' => 'The Bachelor of Science in Accountancy (BSA) program provides students with a strong foundation in accounting principles and practices, preparing them for a career in accounting and finance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_name' => 'Bachelor of Science in Business Administration',
                'course_description' => 'The Bachelor of Science in Business Administration (BSBA) program offers a comprehensive education in business practices, management principles, and strategic planning, equipping students for various roles in the business sector.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
