<?php

namespace Database\Seeders;

use App\Models\Sub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sub::factory()->count(10)->create();
    }
}
