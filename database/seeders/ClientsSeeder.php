<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => 'test' . ($i + 1) . '@gmail.com',
                'password' => Hash::make('testtest'),
            ]);
            $client = Client::where('user_id', $user->id)->first();


            $client->phone_number = $faker->phoneNumber;
            $client->address = $faker->address;
            $client->notes = $faker->text;
            $client->save();
        }
    }
}
