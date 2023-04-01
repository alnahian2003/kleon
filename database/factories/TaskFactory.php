<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(60);
        return [
            'project_id' => fake()->randomElement([Project::inRandomOrder()->first(), null]),
            'title' => $title,
            'slug' => str()->slug($title),
            'comment' => fake()->realText(40),
        ];
    }
}
