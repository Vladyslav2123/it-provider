<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Services extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.services', [
            'services' => Service::where('active', true)
                ->orderBy('order')
                ->get(),
        ]);
    }
}
