<?php

namespace App\Livewire\Admin;

use App\Models\ConnectionRequest;
use App\Models\Tariff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ConnectionRequestEdit extends Component
{
    public $request;
    public $successMessage = '';
    
    protected function rules()
    {
        return [
            'request.name' => 'required|string|max:255',
            'request.email' => 'required|email|max:255',
            'request.phone' => 'required|string|max:255',
            'request.address' => 'required|string|max:255',
            'request.tariff_id' => 'nullable|exists:tariffs,id',
            'request.message' => 'nullable|string',
            'request.status' => 'required|in:new,processing,completed,cancelled',
        ];
    }
    
    public function mount(ConnectionRequest $connectionRequest): void
    {
        // Використовуємо масив атрибутів замість об'єкта моделі для Livewire
        $this->request = $connectionRequest->toArray();
    }
    
    public function save(): void
    {
        $this->validate();
        
        // Знаходимо модель за ID і оновлюємо її атрибути
        $connectionRequest = ConnectionRequest::find($this->request['id']);
        
        // Оновлюємо модель
        $connectionRequest->update([
            'name' => $this->request['name'],
            'email' => $this->request['email'],
            'phone' => $this->request['phone'],
            'address' => $this->request['address'],
            'tariff_id' => $this->request['tariff_id'],
            'message' => $this->request['message'],
            'status' => $this->request['status'],
        ]);
        
        // Оновлюємо масив атрибутів
        $this->request = $connectionRequest->toArray();
        
        $this->successMessage = 'Заявку успішно оновлено!';
    }
    
    public function render(): View|Application|Factory
    {
        return view('livewire.admin.connection-request-edit', [
            'tariffs' => Tariff::where('active', true)->orderBy('name')->get()
        ])->layout('layouts.admin', [
            'title' => 'Редагування заявки',
            'header' => 'Редагування заявки на підключення'
        ]);
    }
}
