<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();
        \App\Models\Category::factory(20)->create();
        \App\Models\Instructor::factory(2)->create();
        \App\Models\Course::factory(5)->create();
        \App\Models\Exam::factory(5)->create();
        \App\Models\ExamQuestion::factory(5)->create();
        \App\Models\Certification::factory(2)->create();
        \App\Models\Lesson::factory(10)->create();
        \App\Models\Post::factory(5)->create();
        \App\Models\Question::factory(5)->create();
        \App\Models\Reply::factory(5)->create();
    }
}
