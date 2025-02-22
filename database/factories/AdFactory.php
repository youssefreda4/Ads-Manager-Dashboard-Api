<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->name(),
            'text' =>fake()->sentence(),
            'phone' =>  '01200000000',
            'status' => 1,
            'user_id' => User::factory()->create(),
            'category_id' => Category::factory()->create() ,
        ];
    }
}
