<?php

namespace Database\Factories;

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
        return [
            'title'             => 'Title of Task '.rand(1, 20),
            'description'       => fake()->text(),
            'assign_to_id'      => User::factory(),
            'assign_by_id'      => User::factory(),
        ];
    }
}
