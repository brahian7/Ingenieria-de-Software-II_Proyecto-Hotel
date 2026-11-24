<?php

namespace Database\Seeders;

use App\Models\Huesped;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HuespedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Huesped::factory()->count(20)->create();
    }
}
