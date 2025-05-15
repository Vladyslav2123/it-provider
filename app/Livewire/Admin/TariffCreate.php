<?php

namespace App\Livewire\Admin;

use App\Models\Tariff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class TariffCreate extends Component
{
    public $name = '';
    public $description = '';
    public $price = 0;
    public $speed = '';
    public $period = 'місяць';
    public $is_popular = false;
    public $active = true;
    public $order = 1;
    public $successMessage = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'speed' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'is_popular' => 'boolean',
            'active' => 'boolean',
            'order' => 'required|integer|min:0',
        ];
    }



    public function save(): void
    {
        $this->validate();

        // Створюємо новий тариф
        Tariff::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'speed' => $this->speed,
            'period' => $this->period,
            'is_popular' => $this->is_popular,
            'active' => $this->active,
            'order' => $this->order,
        ]);

        // Очищаємо форму
        $this->reset(['name', 'description', 'price', 'speed']);
        $this->period = 'місяць';
        $this->is_popular = false;
        $this->active = true;
        $this->order = 1;

        $this->successMessage = 'Тариф успішно створено!';
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.tariff-create')->layout('layouts.admin', [
            'title' => 'Створення тарифу',
            'header' => 'Створення нового тарифу'
        ]);
    }
}
