<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 5 new users with related 10 tasks
        User::factory()
            ->count(5)
            ->hasTasks(3)
            ->create();
    }
}
