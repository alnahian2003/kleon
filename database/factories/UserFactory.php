<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();
        return [
            'name' => $name,
            'username' => str($name)->slug(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'address' => fake()->address(),
            'is_active' => fake()->randomElement([true, false]),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Al Nahian',
            'username' => 'alnahian2003',
            'email' => 'nahian@admin.com',
            'is_admin' => true,
            'company_name' => 'ZovoTeam',
            'address' => 'Mirpur 1, Dhaka, Bangladesh'
        ]);
    }
}
