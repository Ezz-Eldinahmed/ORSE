<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'course_id' => Course::all(['id'])->random()->id,
            'instructor_id' => Instructor::all(['id'])->random()->id,
        ];
    }
}
