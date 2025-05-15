<?php

namespace App\Livewire\Admin;

use App\Models\SliderItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SliderList extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.admin.slider-list', [
            'sliders' => SliderItem::orderBy('order')->get()
        ])->layout('layouts.admin', [
            'title' => 'Слайдери',
            'header' => 'Управління слайдерами'
        ]);
    }
    
    public function toggleActive(SliderItem $slider): void
    {
        $slider->update([
            'active' => !$slider->active
        ]);
    }
    
    public function updateOrder(SliderItem $slider, int $newOrder): void
    {
        if ($newOrder < 1) {
            $newOrder = 1;
        }
        
        $slider->update([
            'order' => $newOrder
        ]);
    }
    
    public function deleteSlider(SliderItem $slider): void
    {
        $slider->delete();
    }
}
