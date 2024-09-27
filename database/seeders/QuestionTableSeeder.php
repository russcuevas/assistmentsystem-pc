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
        $questions = [
            ['question_text' => 'I like to work on cars', 'riasec_id' => 'R'],
            ['question_text' => 'I enjoy solving mathematical problems', 'riasec_id' => 'I'],
            ['question_text' => 'I like to create artwork', 'riasec_id' => 'A'],
            ['question_text' => 'I prefer working with animals', 'riasec_id' => 'S'],
            ['question_text' => 'I like to persuade people', 'riasec_id' => 'E'],
            ['question_text' => 'I enjoy organizing events', 'riasec_id' => 'C'],
        ];

        DB::table('questions')->insert($questions);
    }
}
