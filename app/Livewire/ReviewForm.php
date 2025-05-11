<?php

namespace App\Livewire;

use Livewire\Component;

class ReviewForm extends Component
{
    public $name = '';
    public $email = '';
    public $content = '';
    public $rating = 5;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'nullable|email',
        'content' => 'required|min:10',
        'rating' => 'required|integer|min:1|max:5',
    ];

    public function submit()
    {
        $this->validate();

        \App\Models\Review::create([
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'rating' => $this->rating,
            'approved' => false, // Requires admin approval
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
