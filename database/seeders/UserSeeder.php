<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('testtest'),
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('testtest'),
        ]);
        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test3@gmail.com',
            'password' => Hash::make('testtest'),
        ]);
//        admin
        User::factory()->create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
        ]);
    }
}
