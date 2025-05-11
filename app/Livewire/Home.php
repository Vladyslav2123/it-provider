<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'sliderItems' => \App\Models\SliderItem::where('active', true)
                ->orderBy('order')
                ->get(),
        ])->layout('layouts.landing');
    }
}
