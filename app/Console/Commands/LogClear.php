<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LogClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очищення файлів логів Laravel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Шлях до директорії з логами
        $logPath = storage_path('logs');

        // Перевірка, чи існує директорія
        if (!File::exists($logPath)) {
            $this->error("Директорія логів не існує: {$logPath}");
            return;
        }

        // Отримання всіх файлів логів
        $logFiles = File::glob("{$logPath}/*.log");

        if (empty($logFiles)) {
            $this->info('Файли логів не знайдено.');
            return;
        }

        $count = 0;

        // Очищення кожного файлу логів
        foreach ($logFiles as $logFile) {
            // Отримання імені файлу для виведення
            $fileName = basename($logFile);

            try {
                // Очищення файлу (запис порожнього рядка)
                File::put($logFile, '');
                $this->info("Файл логу очищено: {$fileName}");
                $count++;
            } catch (\Exception $e) {
                $this->error("Помилка при очищенні файлу {$fileName}: {$e->getMessage()}");
            }
        }

        $this->info("Всього очищено файлів логів: {$count}");
    }
}
