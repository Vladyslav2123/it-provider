<?php

namespace App\Console\Commands;

use App\Services\ImageOptimizationService;
use Illuminate\Console\Command;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Оптимізує всі зображення для веб-продуктивності';

    /**
     * Execute the console command.
     */
    public function handle(ImageOptimizationService $imageOptimizationService)
    {
        $this->info('Початок оптимізації зображень...');
        
        $imageOptimizationService->optimizeImages();
        
        $this->info('Оптимізація зображень завершена!');
        
        return Command::SUCCESS;
    }
}
