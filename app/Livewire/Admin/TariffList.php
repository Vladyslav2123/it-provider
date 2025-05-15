<?php

namespace App\Livewire\Admin;

use App\Models\Tariff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class TariffList extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.admin.tariff-list', [
            'tariffs' => Tariff::orderBy('order')->get()
        ])->layout('layouts.admin', [
            'title' => 'Тарифи',
            'header' => 'Управління тарифами'
        ]);
    }
    
    public function toggleActive(Tariff $tariff): void
    {
        $tariff->update([
            'active' => !$tariff->active
        ]);
    }
    
    public function togglePopular(Tariff $tariff): void
    {
        $tariff->update([
            'is_popular' => !$tariff->is_popular
        ]);
    }
    
    public function updateOrder(Tariff $tariff, int $newOrder): void
    {
        if ($newOrder < 1) {
            $newOrder = 1;
        }
        
        $tariff->update([
            'order' => $newOrder
        ]);
    }
    
    public function deleteTariff(Tariff $tariff): void
    {
        $tariff->delete();
    }
}
