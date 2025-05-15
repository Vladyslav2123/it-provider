<?php

namespace App\Livewire\Admin;

use App\Events\ImageUploaded;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReviewEdit extends Component
{
    use WithFileUploads;

    public $review;
    public $newAvatar;
    public $successMessage = '';

    public function mount(Review $review): void
    {
        // Замість присвоєння об'єкта моделі, присвоюємо масив атрибутів
        $this->review = $review->toArray();
    }

    public function save(): void
    {
        $this->validate();

        // Знаходимо модель за ID і оновлюємо її атрибути
        $review = Review::find($this->review['id']);

        // Підготуємо дані для оновлення
        $updateData = [
            'name' => $this->review['name'],
            'email' => $this->review['email'],
            'content' => $this->review['content'],
            'rating' => $this->review['rating'],
            'approved' => $this->review['approved'] ?? false,
        ];

        // Обробляємо завантаження аватара
        if ($this->newAvatar) {
            $avatarPath = $this->newAvatar->store('images/avatars', 'public');
            $updateData['avatar'] = '/storage/' . $avatarPath;
        }

        // Оновлюємо модель
        $review->update($updateData);

        // Викликаємо подію завантаження зображення
        if ($this->newAvatar) {
            event(new ImageUploaded());
        }

        // Оновлюємо масив атрибутів
        $this->review = $review->toArray();

        $this->successMessage = 'Відгук успішно оновлено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.review-edit')->layout('layouts.admin', [
            'title' => 'Редагування відгуку',
            'header' => 'Редагування відгуку'
        ]);
    }

    protected function rules()
    {
        return [
            'review.name' => 'required|string|max:255',
            'review.email' => 'nullable|email|max:255',
            'review.content' => 'required|string',
            'review.rating' => 'required|integer|min:1|max:5',
            'review.approved' => 'boolean',
            'newAvatar' => 'nullable|image|max:1024',
        ];
    }
}
