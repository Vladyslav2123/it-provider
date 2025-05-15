@php use App\Models\Tariff; @endphp
@php use App\Models\Review; @endphp
@php use App\Models\ConnectionRequest; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Адмін-панель - {{ config('app.name', 'Internet Provider') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen admin-dark">
    <nav class="admin-dark-nav border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-400">
                            <i class="fas fa-wifi mr-2"></i>{{ config('app.name', 'Internet Provider') }}
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-tachometer-alt mr-2"></i>Дашборд
                        </a>
                        <a href="{{ route('admin.sliders') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.sliders*') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-images mr-2"></i>Слайдери
                        </a>
                        <a href="{{ route('admin.services') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.services*') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-cogs mr-2"></i>Послуги
                        </a>
                        <a href="{{ route('admin.tariffs') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.tariffs*') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-tags mr-2"></i>Тарифи
                        </a>
                        <a href="{{ route('admin.reviews') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.reviews*') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-comments mr-2"></i>Відгуки
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-400 hover:text-white flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>Вийти
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <header class="admin-dark-header shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">
                <i class="fas fa-tachometer-alt mr-2"></i>Адмін-панель
            </h1>
        </div>
    </header>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="admin-dark-card overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="admin-dark-card p-6 rounded-lg shadow border border-blue-900 bg-blue-900/20">
                                <h2 class="text-xl font-semibold text-blue-400 mb-2"><i class="fas fa-headset mr-2"></i>Заявки
                                    на підключення</h2>
                                <p class="text-3xl font-bold text-white">{{ ConnectionRequest::count() }}</p>
                                <p class="text-sm text-gray-400 mt-2">Загальна кількість заявок</p>
                            </div>

                            <div class="admin-dark-card p-6 rounded-lg shadow border border-green-900 bg-green-900/20">
                                <h2 class="text-xl font-semibold text-green-400 mb-2"><i class="fas fa-tags mr-2"></i>Активні
                                    тарифи</h2>
                                <p class="text-3xl font-bold text-white">{{ Tariff::where('active', true)->count() }}</p>
                                <p class="text-sm text-gray-400 mt-2">Доступні тарифні плани</p>
                            </div>

                            <div
                                class="admin-dark-card p-6 rounded-lg shadow border border-purple-900 bg-purple-900/20">
                                <h2 class="text-xl font-semibold text-purple-400 mb-2"><i
                                        class="fas fa-comments mr-2"></i>Відгуки</h2>
                                <p class="text-3xl font-bold text-white">{{ Review::count() }}</p>
                                <p class="text-sm text-gray-400 mt-2">Загальна кількість відгуків</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-semibold"><i class="fas fa-clipboard-list mr-2"></i>Останні заявки на підключення</h2>
                                <a href="{{ route('admin.connection-requests') }}" class="admin-dark-button px-4 py-2 rounded hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-external-link-alt mr-2"></i> Всі заявки
                                </a>
                            </div>
                            <div class="overflow-x-auto rounded-lg">
                                <table class="min-w-full divide-y divide-gray-700 admin-dark-table">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Ім'я
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Контакти
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Тариф
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Статус
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Дата
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-700">
                                    @foreach(ConnectionRequest::latest()->take(5)->get() as $request)
                                        <tr class="hover:bg-gray-700/50 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium">{{ $request->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm">{{ $request->email }}</div>
                                                <div class="text-sm text-gray-400">{{ $request->phone }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm">{{ $request->tariff ? $request->tariff->name : 'Не вказано' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($request->status === 'new')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full admin-dark-badge-warning items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i> Нова
                                                    </span>
                                                @elseif($request->status === 'processing')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full admin-dark-badge-info items-center">
                                                        <i class="fas fa-sync-alt mr-1"></i> В обробці
                                                    </span>
                                                @elseif($request->status === 'completed')
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full admin-dark-badge-success items-center">
                                                        <i class="fas fa-check-circle mr-1"></i> Завершено
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full admin-dark-badge-danger items-center">
                                                        {{ $request->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                {{ $request->created_at->format('d.m.Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4"><i class="fas fa-edit mr-2"></i>Редагування даних
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <a href="{{ route('admin.sliders') }}"
                                   class="admin-dark-card p-6 rounded-lg border border-gray-700 shadow-md hover:bg-gray-700/50 transition duration-150">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight flex items-center">
                                        <i class="fas fa-images mr-2 text-blue-400"></i>Слайдери
                                    </h5>
                                    <p class="font-normal text-gray-400">Редагування слайдерів на головній сторінці</p>
                                </a>

                                <a href="{{ route('admin.services') }}"
                                   class="admin-dark-card p-6 rounded-lg border border-gray-700 shadow-md hover:bg-gray-700/50 transition duration-150">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight flex items-center">
                                        <i class="fas fa-cogs mr-2 text-green-400"></i>Послуги
                                    </h5>
                                    <p class="font-normal text-gray-400">Редагування послуг, які пропонуються
                                        клієнтам</p>
                                </a>

                                <a href="{{ route('admin.tariffs') }}"
                                   class="admin-dark-card p-6 rounded-lg border border-gray-700 shadow-md hover:bg-gray-700/50 transition duration-150">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight flex items-center">
                                        <i class="fas fa-tags mr-2 text-yellow-400"></i>Тарифи
                                    </h5>
                                    <p class="font-normal text-gray-400">Редагування тарифних планів та цін</p>
                                </a>

                                <a href="{{ route('admin.reviews') }}"
                                   class="admin-dark-card p-6 rounded-lg border border-gray-700 shadow-md hover:bg-gray-700/50 transition duration-150">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight flex items-center">
                                        <i class="fas fa-comments mr-2 text-purple-400"></i>Відгуки
                                    </h5>
                                    <p class="font-normal text-gray-400">Управління відгуками клієнтів</p>
                                </a>

                                <a href="{{ route('admin.connection-requests') }}"
                                   class="admin-dark-card p-6 rounded-lg border border-gray-700 shadow-md hover:bg-gray-700/50 transition duration-150">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight flex items-center">
                                        <i class="fas fa-headset mr-2 text-blue-400"></i>Заявки на підключення
                                    </h5>
                                    <p class="font-normal text-gray-400">Управління заявками на підключення клієнтів</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
