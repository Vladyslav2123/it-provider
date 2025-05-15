<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ImageOptimizationService
{
    /**
     * Запускає процес оптимізації зображень
     *
     * @return void
     */
    public function optimizeImages(): void
    {
        try {
            // Крок 1: Генерація адаптивних зображень в оригінальному форматі
            Artisan::call('images:responsive', ['--force' => true]);
            
            // Крок 2: Генерація WebP версій всіх зображень
            Artisan::call('images:responsive', ['--force' => true, '--webp' => true, '--quality' => 85]);
            
            // Крок 3: Оновлення шляхів до зображень в базі даних на WebP формат
            Artisan::call('images:update-to-webp');
            
            // Крок 4: Очищення кешу
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            
            Log::info('Зображення успішно оптимізовані');
        } catch (\Exception $e) {
            Log::error('Помилка при оптимізації зображень: ' . $e->getMessage());
        }
    }
}
