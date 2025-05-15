<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;

Route::get('/', Home::class)->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('login', function () {
        // Simple login logic for demo purposes
        if (request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ])) {
            if (auth()->attempt(request()->only('email', 'password'))) {
                request()->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            return back()->withErrors([
                'email' => 'Вказані облікові дані не збігаються з нашими записами.',
            ]);
        }
    });
});

Route::post('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Маршрути для редагування слайдерів
    Route::get('/sliders', App\Livewire\Admin\SliderList::class)->name('admin.sliders');
    Route::get('/sliders/create', App\Livewire\Admin\SliderCreate::class)->name('admin.sliders.create');
    Route::get('/sliders/{slider}/edit', App\Livewire\Admin\SliderEdit::class)->name('admin.sliders.edit');

    // Маршрути для редагування послуг
    Route::get('/services', App\Livewire\Admin\ServiceList::class)->name('admin.services');
    Route::get('/services/create', App\Livewire\Admin\ServiceCreate::class)->name('admin.services.create');
    Route::get('/services/{service}/edit', App\Livewire\Admin\ServiceEdit::class)->name('admin.services.edit');

    // Маршрути для редагування тарифів
    Route::get('/tariffs', App\Livewire\Admin\TariffList::class)->name('admin.tariffs');
    Route::get('/tariffs/create', App\Livewire\Admin\TariffCreate::class)->name('admin.tariffs.create');
    Route::get('/tariffs/{tariff}/edit', App\Livewire\Admin\TariffEdit::class)->name('admin.tariffs.edit');

    // Маршрути для редагування відгуків
    Route::get('/reviews', App\Livewire\Admin\ReviewList::class)->name('admin.reviews');
    Route::get('/reviews/{review}/edit', App\Livewire\Admin\ReviewEdit::class)->name('admin.reviews.edit');

    // Маршрути для управління заявками на підключення
    Route::get('/connection-requests', App\Livewire\Admin\ConnectionRequestList::class)->name('admin.connection-requests');
    Route::get('/connection-requests/{connectionRequest}/edit', App\Livewire\Admin\ConnectionRequestEdit::class)->name('admin.connection-requests.edit');
});
