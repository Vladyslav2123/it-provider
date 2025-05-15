<?php

namespace App\Listeners;

use App\Events\ImageUploaded;
use App\Services\ImageOptimizationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class OptimizeUploadedImage implements ShouldQueue
{
    /**
     * Сервіс оптимізації зображень
     *
     * @var ImageOptimizationService
     */
    protected $imageOptimizationService;

    /**
     * Кількість спроб виконання завдання
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Максимальний час виконання в секундах
     *
     * @var int
     */
    public $timeout = 600;

    /**
     * Час очікування перед повторною спробою в секундах
     *
     * @var int
     */
    public $backoff = 60;

    /**
     * Create the event listener.
     */
    public function __construct(ImageOptimizationService $imageOptimizationService)
    {
        $this->imageOptimizationService = $imageOptimizationService;
    }

    /**
     * Handle the event.
     */
    public function handle(ImageUploaded $event): void
    {
        // Запускаємо оптимізацію зображень
        $this->imageOptimizationService->optimizeImages();
    }
}
