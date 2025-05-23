<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'duration' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
