<?php

namespace App\Livewire;

use Livewire\Component;

class Tariffs extends Component
{
    public function render()
    {
        return view('livewire.tariffs', [
            'tariffs' => \App\Models\Tariff::where('active', true)
                ->orderBy('order')
                ->get(),
        ]);
    }
}
