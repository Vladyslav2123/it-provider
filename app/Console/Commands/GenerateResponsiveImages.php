<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class GenerateResponsiveImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:responsive {--force : Force regeneration of all images} {--webp : Convert images to WebP format} {--quality=80 : Quality of the generated images (1-100)}';

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

        // Отримуємо опції команди
        $useWebp = $this->option('webp');
        $quality = (int)$this->option('quality');

        // Перевіряємо якість
        if ($quality < 1 || $quality > 100) {
            $quality = 80; // Значення за замовчуванням
            $this->warn('Quality must be between 1 and 100. Using default value of 80.');
        }

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

        // Розмір для маленьких аватарів
        $avatarSmallSize = [
            'width' => 100,
            'height' => 100,
        ];

        // Директорії з зображеннями
        $directories = [
            'storage/app/public/images/backgrounds' => 'storage/app/public/images/backgrounds',
            'storage/app/public/images/services' => 'storage/app/public/images/services',
            'storage/app/public/images/icons' => 'storage/app/public/images/icons',
            'storage/app/public/images/avatars' => 'storage/app/public/images/avatars',
            'storage/app/public/images/logo' => 'storage/app/public/images/logo',
        ];

        // Створюємо директорії для різних розмірів, якщо вони не існують
        foreach ($sizes as $device => $dimensions) {
            foreach ($directories as $sourceDir => $targetDir) {
                $this->createDirectoryIfNotExists("{$targetDir}/{$device}");
            }
        }

        // Створюємо директорію для маленьких аватарів
        $this->createDirectoryIfNotExists("storage/app/public/images/avatars/small");

        // Обробляємо зображення в кожній директорії
        foreach ($directories as $sourceDir => $targetDir) {
            $this->processImagesInDirectory($sourceDir, $targetDir, $sizes, $useWebp, $quality);

            // Також створюємо WebP-версії в основній директорії
            if ($useWebp) {
                $this->processImagesInMainDirectory($sourceDir, $targetDir, $quality);
            }
        }

        // Обробляємо аватари для директорії small
        $this->processAvatarsForSmallDirectory(
            'storage/app/public/images/avatars',
            $avatarSmallSize,
            $useWebp,
            $quality
        );

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
    private function processImagesInDirectory($sourceDir, $targetDir, $sizes, $useWebp = false, $quality = 80)
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
            $basename = pathinfo($filename, PATHINFO_FILENAME);

            // Пропускаємо файли, які не є зображеннями
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $bar->advance();
                continue;
            }

            // Пропускаємо SVG файли, оскільки вони вже оптимізовані
            if (strtolower($extension) === 'svg') {
                // Просто копіюємо SVG файли без змін
                foreach ($sizes as $device => $dimensions) {
                    $targetPath = "{$targetDir}/{$device}/{$filename}";
                    if (!File::exists($targetPath) || $force) {
                        File::copy($file->getPathname(), $targetPath);
                    }
                }
                $bar->advance();
                continue;
            }

            // Обробляємо зображення для кожного розміру
            foreach ($sizes as $device => $dimensions) {
                // Визначаємо цільовий формат і шлях
                $targetExtension = $useWebp ? 'webp' : $extension;
                $targetFilename = $useWebp ? "{$basename}.webp" : $filename;
                $targetPath = "{$targetDir}/{$device}/{$targetFilename}";

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

                    // Зберігаємо зображення з вказаною якістю
                    $img->save($targetPath, $quality);

                    $this->line("\nGenerated: {$targetPath}");
                } catch (\Exception $e) {
                    $this->error("Error processing {$file->getPathname()}: {$e->getMessage()}");
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->line('');
    }

    /**
     * Обробляє зображення в основній директорії
     */
    private function processImagesInMainDirectory($sourceDir, $targetDir, $quality = 80)
    {
        if (!File::exists($sourceDir)) {
            $this->warn("Source directory does not exist: {$sourceDir}");
            return;
        }

        $files = File::files($sourceDir);
        $force = $this->option('force');

        $this->info("Processing main directory {$sourceDir}...");
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = $file->getExtension();
            $basename = pathinfo($filename, PATHINFO_FILENAME);

            // Пропускаємо файли, які не є зображеннями
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                $bar->advance();
                continue;
            }

            // Пропускаємо SVG файли
            if (strtolower($extension) === 'svg') {
                $bar->advance();
                continue;
            }

            // Визначаємо цільовий шлях
            $targetFilename = "{$basename}.webp";
            $targetPath = "{$targetDir}/{$targetFilename}";

            // Якщо файл вже існує і не вказано --force, пропускаємо
            if (File::exists($targetPath) && !$force) {
                $bar->advance();
                continue;
            }

            try {
                // Створюємо екземпляр ImageManager з драйвером GD
                $manager = new ImageManager(new Driver());

                // Завантажуємо зображення
                $img = $manager->read($file->getPathname());

                // Зберігаємо зображення з вказаною якістю
                $img->save($targetPath, $quality);

                $this->line("\nGenerated: {$targetPath}");
            } catch (\Exception $e) {
                $this->error("Error processing {$file->getPathname()}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->line('');
    }

    /**
     * Обробляє аватари для директорії small
     */
    private function processAvatarsForSmallDirectory($sourceDir, $dimensions, $useWebp = false, $quality = 80)
    {
        if (!File::exists($sourceDir)) {
            $this->warn("Source directory does not exist: {$sourceDir}");
            return;
        }

        // Створюємо директорію small, якщо вона не існує
        $targetDir = "{$sourceDir}/small";
        $this->createDirectoryIfNotExists($targetDir);

        $files = File::files($sourceDir);
        $force = $this->option('force');

        $this->info("Processing avatars for small directory...");
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = $file->getExtension();
            $basename = pathinfo($filename, PATHINFO_FILENAME);

            // Пропускаємо файли, які не є зображеннями
            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $bar->advance();
                continue;
            }

            // Пропускаємо SVG файли
            if (strtolower($extension) === 'svg') {
                $bar->advance();
                continue;
            }

            // Пропускаємо директорії
            if (is_dir($file)) {
                $bar->advance();
                continue;
            }

            // Визначаємо цільовий формат і шлях
            $targetExtension = $useWebp ? 'webp' : $extension;
            $targetFilename = $useWebp ? "{$basename}.webp" : $filename;
            $targetPath = "{$targetDir}/{$targetFilename}";

            // Якщо файл вже існує і не вказано --force, пропускаємо
            if (File::exists($targetPath) && !$force) {
                $bar->advance();
                continue;
            }

            try {
                // Створюємо екземпляр ImageManager з драйвером GD
                $manager = new ImageManager(new Driver());

                // Завантажуємо зображення
                $img = $manager->read($file->getPathname());

                // Змінюємо розмір і обрізаємо до квадрата
                $img = $img->cover($dimensions['width'], $dimensions['height']);

                // Зберігаємо зображення з вказаною якістю
                $img->save($targetPath, $quality);

                $this->line("\nGenerated: {$targetPath}");
            } catch (\Exception $e) {
                $this->error("Error processing {$file->getPathname()}: {$e->getMessage()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->line('');
    }
}
