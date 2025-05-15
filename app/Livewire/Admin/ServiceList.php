<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ServiceList extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.admin.service-list', [
            'services' => Service::orderBy('order')->get()
        ])->layout('layouts.admin', [
            'title' => 'Послуги',
            'header' => 'Управління послугами'
        ]);
    }
    
    public function toggleActive(Service $service): void
    {
        $service->update([
            'active' => !$service->active
        ]);
    }
    
    public function updateOrder(Service $service, int $newOrder): void
    {
        if ($newOrder < 1) {
            $newOrder = 1;
        }
        
        $service->update([
            'order' => $newOrder
        ]);
    }
    
    public function deleteService(Service $service): void
    {
        $service->delete();
    }
}
