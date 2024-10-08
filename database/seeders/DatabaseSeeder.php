<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminTableSeeder::class,
            UsersTableSeeder::class,
            RiasecTableSeeder::class,
            CourseTableSeeder::class,
            PreferredCourseTableSeeder::class,
            QuestionTableSeeder::class,
            OptionsTableSeeder::class,
            ResponsesTableSeeder::class,
            RiasecScoresTableSeeder::class,
        ]);
    }
}
