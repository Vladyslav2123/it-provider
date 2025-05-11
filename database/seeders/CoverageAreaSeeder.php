<?php

namespace Database\Seeders;

use App\Models\CoverageArea;
use Illuminate\Database\Seeder;

class CoverageAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Створення зон покриття
        CoverageArea::create([
            'name' => 'Центр Києва',
            'city' => 'Київ',
            'region' => 'Київська область',
            'postal_code' => '01001',
            'latitude' => 50.4501,
            'longitude' => 30.5234,
            'radius' => 5.0,
            'description' => 'Повне покриття в центрі міста з оптоволоконними з\'єднаннями.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Оболонський район',
            'city' => 'Київ',
            'region' => 'Київська область',
            'postal_code' => '04205',
            'latitude' => 50.5101,
            'longitude' => 30.4973,
            'radius' => 4.0,
            'description' => 'Високошвидкісний інтернет доступний по всьому Оболонському району.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Центр Львова',
            'city' => 'Львів',
            'region' => 'Львівська область',
            'postal_code' => '79000',
            'latitude' => 49.8397,
            'longitude' => 24.0297,
            'radius' => 3.5,
            'description' => 'Сервіс доступний у центральному Львові зі швидкістю до 1 Гбіт/с.',
            'active' => true,
        ]);

        CoverageArea::create([
            'name' => 'Приморський район Одеси',
            'city' => 'Одеса',
            'region' => 'Одеська область',
            'postal_code' => '65000',
            'latitude' => 46.4825,
            'longitude' => 30.7233,
            'radius' => 4.2,
            'description' => 'Покриття по всьому Приморському району з надійними з\'єднаннями.',
            'active' => true,
        ]);
    }
}
