<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use App\Models\Vet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vetNames = [
            'Зайцев К. Е.',
            'Михайлова Т. А.'
        ];
        for ($i = 0; $i < count($vetNames); $i++) {
            $user = User::factory()->create([
                'name' => $vetNames[$i],
                'role' => 'doctor',
                'email' => 'vet' . $i+1 . '@gmail.com',
                'password' => Hash::make('vetvetvet'),
            ]);
            Vet::factory()->create([
                'user_id' => $user->id,
            ]);
            $client = Client::where('user_id', $user->id)->first();
            $client->delete();
        }

    }
}
