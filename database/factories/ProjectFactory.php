<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::factory()->create(),
            'title' => fake()->realText(100),
            'description' => fake()->realText(200),

            'status' => fake()->randomElement([
                'pending',
                'open',
                'completed',
                'cancelled',
                'delayed',
            ]),

            'deadline' => fake()->dateTimeBetween('tomorrow', '+1 month')
        ];
    }
}
