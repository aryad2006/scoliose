<?php

namespace Database\Factories;

use App\Enums\LessonType;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'title' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement([
                LessonType::VIDEO->value,
                LessonType::TEXT->value,
                LessonType::IMAGE->value,
                LessonType::QUIZ->value,
            ]),
            'content' => json_encode(['html' => $this->faker->text()]),
            'order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
