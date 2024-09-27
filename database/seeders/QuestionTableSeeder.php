<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'question_text' => 'What do you enjoy doing the most?',
                'riasec_id' => 'R',
            ],
            [
                'question_text' => 'How do you solve problems?',
                'riasec_id' => 'I',
            ],
        ]);
    }
}
