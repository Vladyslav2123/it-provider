<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GenerateResponsiveImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:responsive {--force : Force regeneration of all images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate responsive versions of images for different screen sizes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating responsive images...');

        // Розміри для різних пристроїв
        $sizes = [
            'mobile' => [
                'width' => 640,
                'height' => null, // Зберігає пропорції
            ],
            'tablet' => [
                'width' => 1024,
                'height' => null, // Зберігає пропорції
            ],
        ];

        // Директорії з зображеннями
        $directories = [
            'public/images/backgrounds' => 'public/images/backgrounds',
            'public/images/services' => 'public/images/services',
            'public/storage/images' => 'storage/app/public/images',
        ];

        // Створюємо директорії для різних розмірів, якщо вони не існують
        foreach ($sizes as $device => $dimensions) {
            foreach ($directories as $sourceDir => $targetDir) {
                $this->createDirectoryIfNotExists("{$targetDir}/{$device}");
            }

            // Створюємо директорію для аватарів
            $this->createDirectoryIfNotExists("storage/app/public/images/avatars/{$device}");
        }

        // Обробляємо зображення в кожній директорії
        foreach ($directories as $sourceDir => $targetDir) {
            $this->processImagesInDirectory($sourceDir, $targetDir, $sizes);
        }

        $this->info('Responsive images generated successfully!');
    }

    /**
     * Створює директорію, якщо вона не існує
     */
    private function createDirectoryIfNotExists($directory)
    {
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info("Created directory: {$directory}");
        }
    }

    /**
     * Обробляє всі зображення в директорії
     */
    private function processImagesInDirectory($sourceDir, $targetDir, $sizes)
    {
        if (!File::exists($sourceDir)) {
            $this->warn("Source directory does not exist: {$sourceDir}");
            return;
        }

        $files = File::files($sourceDir);
        $force = $this->option('force');

        $this->info("Processing {$sourceDir}...");
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = $file->getExtension();

            // Пропускаємо файли, які не є зображеннями
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                $bar->advance();
                continue;
            }

            // Обробляємо зображення для кожного розміру
            foreach ($sizes as $device => $dimensions) {
                $targetPath = "{$targetDir}/{$device}/{$filename}";

                // Якщо файл вже існує і не вказано --force, пропускаємо
                if (File::exists($targetPath) && !$force) {
                    continue;
                }

                try {
                    // Створюємо екземпляр ImageManager з драйвером GD
                    $manager = new ImageManager(new Driver());

                    // Завантажуємо зображення
                    $img = $manager->read($file->getPathname());

                    // Змінюємо розмір
                    $img = $img->resize($dimensions['width'], $dimensions['height']);

                    // Зберігаємо зображення
                    $img->save($targetPath);
                } catch (\Exception $e) {
                    $this->error("Error processing {$file->getPathname()}: {$e->getMessage()}");
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->line('');
    }
}
