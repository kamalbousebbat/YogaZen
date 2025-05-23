<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'subscription_expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
