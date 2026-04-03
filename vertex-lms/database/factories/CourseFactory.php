<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'is_published' => $this->faker->boolean(),
            'order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
