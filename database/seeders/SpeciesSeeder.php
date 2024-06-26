<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Species;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $species = ['Cat', 'Dog', 'Bird', 'Rabbit', 'Fish', 'Reptile', 'Horse', 'Cow', 'Sheep', 'Goat', 'Pig', 'Chicken', 'Duck', 'Turkey', 'Guinea Pig', 'Hamster', 'Ferret', 'Chinchilla', 'Parrot', 'Turtle'];
        $species = ["Кошка", "Собака", "Птица", "Кролик", "Рыба", "Рептилия", "Лошадь", "Корова", "Овца", "Коза", "Свинья", "Цыпленок", "Утка", "Индейка", "Морская свинка", "Хомяк", "Хорек", "Шиншилла", "Попугай", "Черепаха"];

        foreach ($species as $specie) {
            Species::create(['name' => $specie]);
        }
    }
}
