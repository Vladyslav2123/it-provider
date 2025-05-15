<?php

namespace App\Livewire\Admin;

use App\Events\ImageUploaded;
use App\Models\SliderItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $button_text = '';
    public $button_url = '';
    public $order = 1;
    public $active = true;
    public $image;
    public $successMessage = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'active' => 'boolean',
            'image' => 'required|image|max:1024',
        ];
    }



    public function save(): void
    {
        $this->validate();

        // Підготуємо дані для створення
        $createData = [
            'title' => $this->title,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'order' => $this->order,
            'active' => $this->active,
        ];

        // Обробляємо завантаження зображення
        if ($this->image) {
            $imagePath = $this->image->store('images/backgrounds', 'public');
            $createData['image'] = '/storage/' . $imagePath;
        }

        // Створюємо новий слайдер
        SliderItem::create($createData);

        // Викликаємо подію завантаження зображення
        if ($this->image) {
            event(new ImageUploaded());
        }

        // Очищаємо форму
        $this->reset(['title', 'description', 'button_text', 'button_url', 'image']);
        $this->order = 1;
        $this->active = true;

        $this->successMessage = 'Слайдер успішно створено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.slider-create')->layout('layouts.admin', [
            'title' => 'Створення слайдера',
            'header' => 'Створення нового слайдера'
        ]);
    }
}
