<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $content = '';
    public int $rating = 5;
    public bool $success = false;

    protected array $rules = [
        'name' => 'required|min:2',
        'email' => 'nullable|email',
        'content' => 'required|min:10',
        'rating' => 'required|integer|min:1|max:5',
    ];

    public function submit(): void
    {
        $this->validate();

        Review::create([
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'rating' => $this->rating,
            'approved' => false,
        ]);

        $this->reset(['name', 'email', 'content', 'rating']);
        $this->rating = 5;
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}
