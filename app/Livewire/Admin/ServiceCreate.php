<?php

namespace App\Livewire\Admin;

use App\Events\ImageUploaded;
use App\Models\Service;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $order = 1;
    public $active = true;
    public $image;
    public $icon;
    public $successMessage = '';

    public function save(): void
    {
        $this->validate();

        // Підготуємо дані для створення
        $createData = [
            'title' => $this->title,
            'description' => $this->description,
            'order' => $this->order,
            'active' => $this->active,
        ];

        // Обробляємо завантаження зображень
        if ($this->image) {
            $imagePath = $this->image->store('images/backgrounds', 'public');
            $createData['image'] = '/storage/' . $imagePath;
        }

        if ($this->icon) {
            $iconPath = $this->icon->store('images/icons', 'public');
            $createData['icon'] = '/storage/' . $iconPath;
        }

        // Створюємо новий сервіс
        Service::create($createData);

        // Викликаємо подію завантаження зображення
        if ($this->image || $this->icon) {
            event(new ImageUploaded());
        }

        // Очищаємо форму
        $this->reset(['title', 'description', 'image', 'icon']);
        $this->order = Service::count() + 1;
        $this->active = true;

        $this->successMessage = 'Послугу успішно створено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.service-create')->layout('layouts.admin', [
            'title' => 'Створення послуги',
            'header' => 'Створення нової послуги'
        ]);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer|min:0',
            'active' => 'boolean',
            'image' => 'nullable|image|max:1024',
            'icon' => 'nullable|image|max:1024',
        ];
    }


}
