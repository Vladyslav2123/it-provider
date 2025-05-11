<?php

namespace App\Livewire;

use App\Mail\ConnectionRequestMail;
use App\Models\ConnectionRequest;
use App\Models\Tariff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;

class ConnectionRequestForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $tariff_id = null;
    public $message = '';
    public $showModal = false;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'tariff_id' => 'nullable|exists:tariffs,id',
        'message' => 'nullable|string',
    ];

    #[On('openModal')]
    public function openModal($tariffId = null): void
    {
        $this->reset(['name', 'email', 'phone', 'address', 'message', 'success']);

        // Якщо tariffId передано як масив з параметрами
        if (is_array($tariffId) && isset($tariffId['tariffId'])) {
            $this->tariff_id = $tariffId['tariffId'];
        } else {
            $this->tariff_id = $tariffId;
        }

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function submit(): void
    {
        $this->validate();

        // Створення запису в базі даних
        $connectionRequest = ConnectionRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'tariff_id' => $this->tariff_id,
            'message' => $this->message,
            'status' => 'new',
        ]);

        // Завантаження зв'язаного тарифу для використання в листі
        $connectionRequest->load('tariff');

        try {
            // Відправка листа (наразі в логи)
            Mail::to(config('mail.from.address'))
                ->send(new ConnectionRequestMail($connectionRequest));

            // Логування даних заявки
            Log::info('Нова заявка на підключення', [
                'id' => $connectionRequest->id,
                'name' => $connectionRequest->name,
                'email' => $connectionRequest->email,
                'phone' => $connectionRequest->phone,
                'address' => $connectionRequest->address,
                'tariff' => $connectionRequest->tariff ? $connectionRequest->tariff->name : null,
                'message' => $connectionRequest->message,
            ]);
        } catch (\Exception $e) {
            // Логування помилки, але не показуємо її користувачу
            Log::error('Помилка відправки листа: ' . $e->getMessage());
        }

        $this->success = true;
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.connection-request-form', [
            'tariffs' => Tariff::where('active', true)->orderBy('name')->get(),
        ]);
    }
}
