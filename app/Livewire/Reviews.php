<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class Reviews extends Component
{
    public function render()
    {
        return view('livewire.reviews', [
            'reviews' => Review::where('approved', true)
                ->inRandomOrder()
                ->limit(5)
                ->get(),
        ]);
    }
}
