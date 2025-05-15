<?php

namespace App\Livewire\Admin;

use App\Models\Tariff;
use Livewire\Component;

class TariffEdit extends Component
{
    public $tariff;
    public $successMessage = '';

    public function mount(Tariff $tariff): void
    {
        // Замість присвоєння об'єкта моделі, присвоюємо масив атрибутів
        $this->tariff = $tariff->toArray();
    }

    public function save(): void
    {
        $this->validate();

        // Знаходимо модель за ID і оновлюємо її атрибути
        $tariff = Tariff::find($this->tariff['id']);
        $tariff->update([
            'name' => $this->tariff['name'],
            'description' => $this->tariff['description'],
            'price' => $this->tariff['price'],
            'speed' => $this->tariff['speed'],
            'period' => $this->tariff['period'],
            'is_popular' => $this->tariff['is_popular'] ?? false,
            'active' => $this->tariff['active'] ?? true,
            'order' => $this->tariff['order'],
        ]);

        // Оновлюємо масив атрибутів
        $this->tariff = $tariff->toArray();

        $this->successMessage = 'Тариф успішно оновлено!';
    }

    public function render()
    {
        return view('livewire.admin.tariff-edit')->layout('layouts.admin', [
            'title' => 'Редагування тарифу',
            'header' => 'Редагування тарифу'
        ]);
    }

    protected function rules()
    {
        return [
            'tariff.name' => 'required|string|max:255',
            'tariff.description' => 'required|string',
            'tariff.price' => 'required|numeric|min:0',
            'tariff.speed' => 'required|string|max:255',
            'tariff.period' => 'required|string|max:255',
            'tariff.is_popular' => 'boolean',
            'tariff.active' => 'boolean',
            'tariff.order' => 'required|integer|min:0',
        ];
    }


}
