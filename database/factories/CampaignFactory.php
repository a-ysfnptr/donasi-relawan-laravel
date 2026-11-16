<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'category' => 'sosial',
            'description' => fake()->paragraph(),
            'target_amount' => 5000000,
            'deadline' => now()->addDays(30)->toDateString(),
            'status' => 'aktif',
            'created_by' => User::factory()->admin(),
        ];
    }
}
