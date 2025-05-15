<?php

namespace App\Livewire\Admin;

use App\Models\ConnectionRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ConnectionRequestList extends Component
{
    use WithPagination;
    
    public $statusFilter = '';
    public $search = '';
    
    public function render(): View|Application|Factory
    {
        $query = ConnectionRequest::query()
            ->with('tariff')
            ->latest();
            
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhere('address', 'like', '%' . $this->search . '%');
            });
        }
        
        return view('livewire.admin.connection-request-list', [
            'requests' => $query->paginate(10)
        ])->layout('layouts.admin', [
            'title' => 'Заявки на підключення',
            'header' => 'Управління заявками на підключення'
        ]);
    }
    
    public function updateStatus(ConnectionRequest $connectionRequest, string $status): void
    {
        $connectionRequest->update([
            'status' => $status
        ]);
    }
    
    public function deleteRequest(ConnectionRequest $connectionRequest): void
    {
        $connectionRequest->delete();
    }
    
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    
    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }
}
