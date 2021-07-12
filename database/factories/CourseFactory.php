<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

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
            'category_id' => Category::all(['id'])->random()->id,
            'instructor_id' => Instructor::all(['id'])->random()->id,
            'assignments' => $this->faker->randomElement(['on', 'off']),
            'presentation' => $this->faker->randomElement(['Slides', 'FreeHand', 'Talking']),
            'speed' =>  $this->faker->randomElement(['Slow', 'Normal', 'Fast']),
            'price' => $this->faker->randomDigit,
            'approved' => 1
        ];
    }
}
