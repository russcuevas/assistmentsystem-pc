<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiasecTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 'R', 'description' => 'Realistic'],
            ['id' => 'I', 'description' => 'Investigative'],
            ['id' => 'A', 'description' => 'Artistic'],
            ['id' => 'S', 'description' => 'Social'],
            ['id' => 'E', 'description' => 'Enterprising'],
            ['id' => 'C', 'description' => 'Conventional'],
        ];

        DB::table('riasecs')->insert($data);
    }
}
