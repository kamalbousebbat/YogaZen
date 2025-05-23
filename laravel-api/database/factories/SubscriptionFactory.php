<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        $started_at = $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'student_id' => \App\Models\Student::factory(),
            'type' => $this->faker->randomElement(['basic', 'premium', 'pro']),
            'started_at' => $started_at,
            'expires_at' => $this->faker->dateTimeBetween($started_at, '+1 year'),
        ];
    }
}
