<?php

namespace App\Livewire;

use App\Models\SliderItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Slider extends Component
{
    public int $activeSlide = 0;
    public $items = [];

    public function mount(): void
    {
        $this->items = SliderItem::where('active', true)
            ->orderBy('order')
            ->get();
    }

    public function nextSlide(): void
    {
        if (count($this->items) > 0) {
            $this->activeSlide = ($this->activeSlide + 1) % count($this->items);
        }
    }

    public function prevSlide(): void
    {
        if (count($this->items) > 0) {
            $this->activeSlide = ($this->activeSlide - 1 + count($this->items)) % count($this->items);
        }
    }

    public function goToSlide($index): void
    {
        if ($index >= 0 && $index < count($this->items)) {
            $this->activeSlide = $index;
        }
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.slider');
    }
}
