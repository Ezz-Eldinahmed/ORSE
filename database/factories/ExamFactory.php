<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::all(['id'])->random()->id,
            'level' => $this->faker->randomElement([1,2,3]),
        ];
    }
}
