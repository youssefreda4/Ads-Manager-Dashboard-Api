<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_name' => 'Api Course',
            'about_us' =>fake()->unique()->sentence() ,
            'why_us' =>fake()->unique()->sentence() ,
            'goal' =>fake()->unique()->sentence() ,
            'vision' =>fake()->unique()->sentence() ,
            'about_footer' =>fake()->unique()->sentence() ,
            'ads_text' =>fake()->unique()->sentence() ,
            'activities_text' =>fake()->unique()->sentence() ,
            'person_text' =>fake()->unique()->sentence() ,
            'contact_us_text' =>fake()->unique()->sentence() ,
            'terms_text' =>fake()->unique()->sentence() ,
            'activite_terms' =>fake()->unique()->sentence() ,
            'counter1_name' =>fake()->unique()->name() ,
            'counter1_count' =>fake()->numberBetween(1,100) ,
        ];
    }
}
