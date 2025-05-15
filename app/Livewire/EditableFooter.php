<?php

namespace App\Livewire;

use App\Models\FooterSetting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class EditableFooter extends Component
{
    public $isEditing = false;
    public $settings = [];
    public $successMessage = '';

    protected $rules = [
        'settings.company_description' => 'required|string',
        'settings.facebook_url' => 'nullable|string',
        'settings.twitter_url' => 'nullable|string',
        'settings.instagram_url' => 'nullable|string',
        'settings.address' => 'required|string',
        'settings.phone' => 'required|string',
        'settings.email' => 'required|email',
        'settings.working_hours' => 'required|string',
        'settings.copyright_text' => 'required|string',
        'settings.privacy_policy_url' => 'nullable|string',
        'settings.terms_url' => 'nullable|string',
    ];

    public function mount(): void
    {
        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $keys = [
            'company_description',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'address',
            'phone',
            'email',
            'working_hours',
            'copyright_text',
            'privacy_policy_url',
            'terms_url',
        ];

        foreach ($keys as $key) {
            $this->settings[$key] = FooterSetting::getValue($key, '');
        }
    }

    public function toggleEdit(): void
    {
        // Тільки адміністратори можуть редагувати
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return;
        }

        $this->isEditing = !$this->isEditing;

        if ($this->isEditing) {
            $this->loadSettings();
        }
    }

    public function save(): void
    {
        // Тільки адміністратори можуть зберігати
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return;
        }

        $this->validate();

        foreach ($this->settings as $key => $value) {
            FooterSetting::setValue($key, $value);
        }

        $this->isEditing = false;
        $this->successMessage = 'Налаштування футера успішно оновлено!';

        // Очищаємо повідомлення про успіх через 2 секунди
        $this->dispatch('clearMessage');
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.editable-footer');
    }
}
