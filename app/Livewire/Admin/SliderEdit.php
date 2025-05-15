<?php

namespace App\Livewire\Admin;

use App\Events\ImageUploaded;
use App\Models\SliderItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderEdit extends Component
{
    use WithFileUploads;

    public $slider;
    public $newImage;
    public $successMessage = '';

    public function mount(SliderItem $slider): void
    {
        // Замість присвоєння об'єкта моделі, присвоюємо масив атрибутів
        $this->slider = $slider->toArray();
    }

    public function save(): void
    {
        $this->validate();

        // Знаходимо модель за ID і оновлюємо її атрибути
        $slider = SliderItem::find($this->slider['id']);

        // Підготуємо дані для оновлення
        $updateData = [
            'title' => $this->slider['title'],
            'description' => $this->slider['description'],
            'button_text' => $this->slider['button_text'],
            'button_url' => $this->slider['button_url'],
            'order' => $this->slider['order'],
            'active' => $this->slider['active'] ?? false,
        ];

        // Обробляємо завантаження зображення
        if ($this->newImage) {
            $imagePath = $this->newImage->store('images/backgrounds', 'public');
            $updateData['image'] = '/storage/' . $imagePath;
        }

        // Оновлюємо модель
        $slider->update($updateData);

        // Викликаємо подію завантаження зображення
        if ($this->newImage) {
            Log::info('ImageUploaded event called');
            event(new ImageUploaded());
        }

        // Оновлюємо масив атрибутів
        $this->slider = $slider->toArray();

        $this->successMessage = 'Слайдер успішно оновлено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.slider-edit')->layout('layouts.admin', [
            'title' => 'Редагування слайдера',
            'header' => 'Редагування слайдера'
        ]);
    }

    protected function rules()
    {
        return [
            'slider.title' => 'required|string|max:255',
            'slider.description' => 'nullable|string',
            'slider.button_text' => 'nullable|string|max:255',
            'slider.button_url' => 'nullable|string|max:255',
            'slider.order' => 'required|integer|min:0',
            'slider.active' => 'boolean',
            'newImage' => 'nullable|image|max:1024',
        ];
    }
}
