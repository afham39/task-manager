<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $evaluator = User::factory()->create([
            'name' => 'Evaluator Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Task::factory()->count(15)->create([
            'user_id' => $evaluator->id,
        ]);
    }
}
