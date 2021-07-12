<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\Course;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Certification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'grade' => $this->faker->randomDigit,
            'full_mark' => $this->faker->randomDigit,
            'course_id' => Course::all(['id'])->random()->id,
            'user_id' => User::all(['id'])->random()->id,
            'exam_id' => Exam::all(['id'])->random()->id,
            'status' => 'failed'
        ];
    }
}
