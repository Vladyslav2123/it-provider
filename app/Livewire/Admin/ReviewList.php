<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewList extends Component
{
    use WithPagination;

    public $statusFilter = '';
    public $ratingFilter = '';

    public function render(): View|Application|Factory
    {
        $query = Review::query()->latest();

        if ($this->statusFilter !== '') {
            $query->where('approved', $this->statusFilter === 'approved');
        }

        if ($this->ratingFilter !== '') {
            $query->where('rating', $this->ratingFilter);
        }

        return view('livewire.admin.review-list', [
            'reviews' => $query->paginate(10)
        ])->layout('layouts.admin', [
            'title' => 'Відгуки',
            'header' => 'Управління відгуками'
        ]);
    }

    public function toggleApproved(Review $review): void
    {
        $review->update([
            'approved' => !$review->approved
        ]);
    }

    public function deleteReview(Review $review): void
    {
        $review->delete();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatedRatingFilter(): void
    {
        $this->resetPage();
    }
}
