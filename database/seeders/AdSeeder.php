<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Seeder;
use Database\Factories\AdFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ad::factory(50)->create();
    }
}
