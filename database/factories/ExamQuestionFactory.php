<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExamQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exam_id' => Exam::all(['id'])->random()->id,
            'course_id' => Course::all(['id'])->random()->id,
            'difficulty' => $this->faker->randomElement([1,2,3]),
            'question' => $this->faker->text,
            'a'=> $this->faker->text,
            'b'=> $this->faker->text,
            'c'=> $this->faker->text,
            'd'=> $this->faker->text,
            'correct' => $this->faker->randomElement(['a','b','c','d']),
        ];
    }
}
