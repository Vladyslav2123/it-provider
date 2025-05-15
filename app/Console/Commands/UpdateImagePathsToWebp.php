<?php

namespace App\Console\Commands;

use App\Models\Review;
use App\Models\Service;
use App\Models\SliderItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateImagePathsToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:update-to-webp {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update image paths in the database to use WebP format';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('Running in dry-run mode. No changes will be made to the database.');
        }

        $this->updateSliderImages($dryRun);
        $this->updateServiceImages($dryRun);
        $this->updateReviewAvatars($dryRun);

        if ($dryRun) {
            $this->info('Dry run completed. Run without --dry-run to apply changes.');
        } else {
            $this->info('All image paths have been updated to WebP format.');
        }
    }

    /**
     * Update slider images to WebP format
     */
    private function updateSliderImages($dryRun)
    {
        $this->info('Updating slider images...');

        $sliders = SliderItem::all();
        $count = 0;

        foreach ($sliders as $slider) {
            if (empty($slider->image)) {
                continue;
            }

            $currentPath = $slider->image;
            $extension = pathinfo($currentPath, PATHINFO_EXTENSION);

            // Skip if already WebP
            if (strtolower($extension) === 'webp') {
                continue;
            }

            $directory = pathinfo($currentPath, PATHINFO_DIRNAME);
            $filename = pathinfo($currentPath, PATHINFO_FILENAME);
            $newPath = "{$directory}/{$filename}.webp";

            // Перевіряємо різні можливі шляхи для WebP-версії
            $possiblePaths = [
                // Шлях відносно storage/app/public
                storage_path('app/public/' . ltrim(str_replace('/storage/', '', $newPath), '/')),

                // Шлях для мобільних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'mobile/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),

                // Шлях для планшетних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'tablet/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),
            ];

            $webpExists = false;
            $actualPath = null;

            foreach ($possiblePaths as $path) {
                if (File::exists($path)) {
                    $webpExists = true;
                    $actualPath = $path;
                    break;
                }
            }

            if (!$webpExists) {
                $this->warn("WebP version not found for: {$currentPath}");
                $this->line(
                    "Checked paths: " . implode(", ", array_map(function ($p) {
                        return basename($p);
                    }, $possiblePaths))
                );
                continue;
            }

            $this->line("Updating: {$currentPath} -> {$newPath}");

            if (!$dryRun) {
                $slider->image = $newPath;
                $slider->save();
            }

            $count++;
        }

        $this->info("Updated {$count} slider images.");
    }

    /**
     * Update service images to WebP format
     */
    private function updateServiceImages($dryRun)
    {
        $this->info('Updating service images...');

        $services = Service::all();
        $count = 0;

        foreach ($services as $service) {
            if (empty($service->image)) {
                continue;
            }

            $currentPath = $service->image;
            $extension = pathinfo($currentPath, PATHINFO_EXTENSION);

            // Skip if already WebP
            if (strtolower($extension) === 'webp') {
                continue;
            }

            $directory = pathinfo($currentPath, PATHINFO_DIRNAME);
            $filename = pathinfo($currentPath, PATHINFO_FILENAME);
            $newPath = "{$directory}/{$filename}.webp";

            // Перевіряємо різні можливі шляхи для WebP-версії
            $possiblePaths = [
                // Шлях відносно storage/app/public
                storage_path('app/public/' . ltrim(str_replace('/storage/', '', $newPath), '/')),

                // Шлях для мобільних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'mobile/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),

                // Шлях для планшетних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'tablet/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),
            ];

            $webpExists = false;
            $actualPath = null;

            foreach ($possiblePaths as $path) {
                if (File::exists($path)) {
                    $webpExists = true;
                    $actualPath = $path;
                    break;
                }
            }

            if (!$webpExists) {
                $this->warn("WebP version not found for: {$currentPath}");
                $this->line(
                    "Checked paths: " . implode(", ", array_map(function ($p) {
                        return basename($p);
                    }, $possiblePaths))
                );
                continue;
            }

            $this->line("Updating: {$currentPath} -> {$newPath}");

            if (!$dryRun) {
                $service->image = $newPath;
                $service->save();
            }

            $count++;
        }

        $this->info("Updated {$count} service images.");
    }

    /**
     * Update review avatars to WebP format
     */
    private function updateReviewAvatars($dryRun)
    {
        $this->info('Updating review avatars...');

        $reviews = Review::all();
        $count = 0;

        foreach ($reviews as $review) {
            if (empty($review->avatar)) {
                continue;
            }

            $currentPath = $review->avatar;
            $extension = pathinfo($currentPath, PATHINFO_EXTENSION);

            // Skip if already WebP
            if (strtolower($extension) === 'webp') {
                continue;
            }

            $directory = pathinfo($currentPath, PATHINFO_DIRNAME);
            $filename = pathinfo($currentPath, PATHINFO_FILENAME);
            $newPath = "{$directory}/{$filename}.webp";

            // Перевіряємо різні можливі шляхи для WebP-версії
            $possiblePaths = [
                // Шлях відносно storage/app/public
                storage_path('app/public/' . ltrim(str_replace('/storage/', '', $newPath), '/')),

                // Шлях для мобільних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'mobile/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),

                // Шлях для планшетних версій
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'tablet/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),

                // Шлях для маленьких аватарів
                storage_path('app/public/' . ltrim(str_replace(basename($newPath), 'small/' . basename($newPath), str_replace('/storage/', '', $newPath)), '/')),
            ];

            $webpExists = false;
            $actualPath = null;

            foreach ($possiblePaths as $path) {
                if (File::exists($path)) {
                    $webpExists = true;
                    $actualPath = $path;
                    break;
                }
            }

            if (!$webpExists) {
                $this->warn("WebP version not found for: {$currentPath}");
                $this->line(
                    "Checked paths: " . implode(", ", array_map(function ($p) {
                        return basename($p);
                    }, $possiblePaths))
                );
                continue;
            }

            $this->line("Updating: {$currentPath} -> {$newPath}");

            if (!$dryRun) {
                $review->avatar = $newPath;
                $review->save();
            }

            $count++;
        }

        $this->info("Updated {$count} review avatars.");
    }
}
