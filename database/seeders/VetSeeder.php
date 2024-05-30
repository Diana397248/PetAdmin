<?php

namespace Database\Seeders;

use App\Models\Vet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vet::factory()->create([
            'user_id' => 1,
        ]);
        Vet::factory()->create([
            'user_id' => 2,
        ]);
    }
}