<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Every 5 Users
        User::factory()
            ->count(5)
            ->hasProjects(3)
            ->create();
    }
}
