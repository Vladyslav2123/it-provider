<?php

namespace App\Livewire\Admin;

use App\Events\ImageUploaded;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceEdit extends Component
{
    use WithFileUploads;

    public $service;
    public $newImage;
    public $newIcon;
    public $successMessage = '';

    protected function rules()
    {
        return [
            'service.title' => 'required|string|max:255',
            'service.description' => 'required|string',
            'service.order' => 'required|integer|min:0',
            'service.active' => 'boolean',
            'newImage' => 'nullable|image|max:1024',
            'newIcon' => 'nullable|image|max:1024',
        ];
    }



    public function mount(Service $service): void
    {
        // Замість присвоєння об'єкта моделі, присвоюємо масив атрибутів
        $this->service = $service->toArray();
    }

    public function save(): void
    {
        $this->validate();

        // Знаходимо модель за ID і оновлюємо її атрибути
        $service = Service::find($this->service['id']);

        // Підготуємо дані для оновлення
        $updateData = [
            'title' => $this->service['title'],
            'description' => $this->service['description'],
            'order' => $this->service['order'],
            'active' => $this->service['active'] ?? false,
        ];

        // Обробляємо завантаження зображень
        if ($this->newImage) {
            $imagePath = $this->newImage->store('images/backgrounds', 'public');
            $updateData['image'] = '/storage/' . $imagePath;
        }

        if ($this->newIcon) {
            $iconPath = $this->newIcon->store('images/icons', 'public');
            $updateData['icon'] = '/storage/' . $iconPath;
        }

        // Оновлюємо модель
        $service->update($updateData);

        // Викликаємо подію завантаження зображення
        if ($this->newImage || $this->newIcon) {
            event(new ImageUploaded());
        }

        // Оновлюємо масив атрибутів
        $this->service = $service->toArray();

        $this->successMessage = 'Послугу успішно оновлено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.service-edit')->layout('layouts.admin', [
            'title' => 'Редагування послуги',
            'header' => 'Редагування послуги'
        ]);
    }
}
