<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiasecScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'riasec_id' => 'R', 'points' => 10],
            ['user_id' => 1, 'riasec_id' => 'I', 'points' => 5],
            ['user_id' => 1, 'riasec_id' => 'A', 'points' => 3],
            ['user_id' => 1, 'riasec_id' => 'S', 'points' => 2],
            ['user_id' => 1, 'riasec_id' => 'E', 'points' => 1],
            ['user_id' => 1, 'riasec_id' => 'C', 'points' => 0],
        ];

        DB::table('riasec_scores')->insert($data);
    }
}
