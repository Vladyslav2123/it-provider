<?php

namespace App\Livewire;

use App\Mail\ConnectionRequestMail;
use App\Models\ConnectionRequest;
use App\Models\Tariff;
use Exception;
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
        'tariff_id' => 'required|exists:tariffs,id',
        'message' => 'nullable|string',
    ];

    protected $messages = [
        'tariff_id.required' => 'Будь ласка, оберіть тарифний план',
        'tariff_id.exists' => 'Обраний тарифний план не існує',
    ];

    #[On('openModal')]
    public function openModal($tariffId = null): void
    {
        $this->reset(['name', 'email', 'phone', 'address', 'message', 'success']);

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

        $connectionRequest = ConnectionRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'tariff_id' => $this->tariff_id,
            'message' => $this->message,
            'status' => 'new',
        ]);

        $connectionRequest->load('tariff');

        try {
            Mail::to(config('mail.from.address'))
                ->send(new ConnectionRequestMail($connectionRequest));

            Log::info('Нова заявка на підключення', [
                'id' => $connectionRequest->id,
                'name' => $connectionRequest->name,
                'email' => $connectionRequest->email,
                'phone' => $connectionRequest->phone,
                'address' => $connectionRequest->address,
                'tariff' => $connectionRequest->tariff ? $connectionRequest->tariff->name : null,
                'message' => $connectionRequest->message,
            ]);
        } catch (Exception $e) {
            Log::error('Помилка відправки листа: ' . $e->getMessage());
        }
        $this->reset();
        $this->success = true;
    }

    public function updated(): void
    {
        Log::info('Form updated');
        $this->resetValidation();
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.connection-request-form', [
            'tariffs' => Tariff::where('active', true)->orderBy('name')->get(),
        ]);
    }
}
