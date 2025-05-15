<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'company_description' => 'Надаємо високошвидкісні рішення для волоконного інтернету з неперевершеною надійністю та обслуговуванням клієнтів.',
            'facebook_url' => '#',
            'twitter_url' => '#',
            'instagram_url' => '#',
            'address' => 'вул. Інтернетна 123, Діджитал Сіті',
            'phone' => '(123) 456-7890',
            'email' => 'info@speednet.com',
            'working_hours' => 'Пн-Пт: 8:00-20:00, Сб: 9:00-17:00',
            'copyright_text' => 'SpeedNet. Всі права захищені.',
            'privacy_policy_url' => '#',
            'terms_url' => '#',
        ];
        
        foreach ($settings as $key => $value) {
            FooterSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
