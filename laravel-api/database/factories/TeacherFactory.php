<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'bio' => $this->faker->paragraph,
            'specialties' => $this->faker->words(3),
        ];
    }
}
