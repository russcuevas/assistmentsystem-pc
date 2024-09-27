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
            ['id' => 'R', 'riasec_name' => 'Realistic', 'description' => 'These people are often good at mechanical or athletic 
                                                                        jobs. Good college majors for Realistic people are…'],
            ['id' => 'I', 'riasec_name' => 'Investigative', 'description' => 'These people like to watch, learn, analyze and solve 
                                                                                    problems. Good college majors for Investigative 
                                                                                    people are…'],
            ['id' => 'A', 'riasec_name' => 'Artistic', 'description' => ' These people like to work in unstructured situations 
                                                                            where they can use their creativity. Good majors for 
                                                                            Artistic people are…'],
            ['id' => 'S', 'riasec_name' => 'Social', 'description' => 'These people like to work with other people,  
                                                                        rather than things. Good college majors for  
                                                                        Social people are…'],
            ['id' => 'E', 'riasec_name' => 'Enterprising', 'description' => ' These people like to work with others and enjoy 
                                                                                persuading and and performing. Good college majors 
                                                                                for Enterprising people are..'],
            ['id' => 'C', 'riasec_name' => 'Conventional', 'description' => 'These people are very detail oriented,organized  
                                                                                and like to work with data. Good college majors  
                                                                                for Conventional people are…'],
        ];

        DB::table('riasecs')->insert($data);
    }
}
