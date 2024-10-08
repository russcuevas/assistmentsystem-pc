<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('options')->insert([
            [
                'question_id' => 1,
                'option_text' => 'R',
                'is_correct' => 1,
            ],
            [
                'question_id' => 2,
                'option_text' => 'I',
                'is_correct' => 1,
            ],
            [
                'question_id' => 3,
                'option_text' => 'A',
                'is_correct' => 1,
            ],
            [
                'question_id' => 4,
                'option_text' => 'S',
                'is_correct' => 1,
            ],
            [
                'question_id' => 5,
                'option_text' => 'E',
                'is_correct' => 1,
            ],
            [
                'question_id' => 6,
                'option_text' => 'C',
                'is_correct' => 1,
            ],
        ]);
    }
}
