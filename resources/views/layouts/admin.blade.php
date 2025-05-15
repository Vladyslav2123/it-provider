<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Адмін-панель') - {{ config('app.name', 'Internet Provider') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
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
                        <a href="{{ route('admin.connection-requests') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.connection-requests*') ? 'active border-blue-500' : 'border-transparent' }} text-sm font-medium leading-5 focus:outline-none transition">
                            <i class="fas fa-headset mr-2"></i>Заявки
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
                @yield('header', 'Адмін-панель')
            </h1>
        </div>
    </header>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="admin-dark-card overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-700">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@livewireScripts
</body>
</html>
