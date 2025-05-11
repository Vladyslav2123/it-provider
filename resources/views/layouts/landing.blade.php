<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Швидкі та надійні послуги інтернет-провайдера">

    <title>{{ config('app.name', 'Internet Provider') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Font Awesome (Local) -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/all.min.css') }}"/>

    <!-- Background Images CSS -->
    <link rel="stylesheet" href="{{ asset('css/backgrounds.css') }}"/>

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen cyber-bg">
    <!-- Navigation -->
    <nav class="cyber-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold cyber-text flex items-center">
                            <img src="{{ asset('images/logo/speednet-logo.svg') }}" alt="SpeedNet Logo" class="h-10">
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="#services"
                           class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                            Послуги
                        </a>
                        <a href="#tariffs"
                           class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                            Тарифи
                        </a>
                        <a href="#coverage"
                           class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                            Карта покриття
                        </a>
                        <a href="#reviews"
                           class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                            Відгуки
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <button
                        onclick="window.openConnectionModal()"
                        class="cyber-button inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150"
                    >
                        Підключитись
                    </button>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button id="mobile-menu-button"
                            class="inline-flex items-center justify-center p-2 rounded-md cyber-text hover:text-gray-400 focus:outline-none focus:text-gray-400 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="#services"
                   class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                    Послуги
                </a>
                <a href="#tariffs"
                   class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                    Тарифи
                </a>
                <a href="#coverage"
                   class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                    Карта покриття
                </a>
                <a href="#reviews"
                   class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium cyber-text hover:text-gray-400 hover:border-gray-600 focus:outline-none focus:text-gray-400 focus:border-gray-600 transition">
                    Відгуки
                </a>
                <div class="mt-3 px-3">
                    <button
                        onclick="window.openConnectionModal()"
                        class="cyber-button w-full flex justify-center items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150"
                    >
                        Підключитись
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="cyber-footer py-12 cyber-grid-lines">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="mb-4">
                        <img src="{{ asset('images/logo/speednet-logo.svg') }}" alt="SpeedNet Logo" class="h-10 mb-2">
                    </div>
                    <p class="cyber-text">Надаємо високошвидкісні рішення для волоконного інтернету з неперевершеною
                        надійністю та обслуговуванням клієнтів.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="cyber-text hover:text-gray-400 transition-colors"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="cyber-text hover:text-gray-400 transition-colors"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="cyber-text hover:text-gray-400 transition-colors"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 cyber-heading">Швидкі посилання</h3>
                    <ul class="space-y-2">
                        <li><a href="#services" class="cyber-text hover:text-gray-400 transition-colors">Послуги</a>
                        </li>
                        <li><a href="#tariffs" class="cyber-text hover:text-gray-400 transition-colors">Тарифи</a></li>
                        <li><a href="#coverage" class="cyber-text hover:text-gray-400 transition-colors">Карта
                                покриття</a>
                        </li>
                        <li><a href="#reviews" class="cyber-text hover:text-gray-400 transition-colors">Відгуки</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 cyber-heading">Контакти</h3>
                    <ul class="space-y-2 cyber-text">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>вул. Інтернетна 123, Діджитал Сіті</li>
                        <li><i class="fas fa-phone mr-2"></i>(123) 456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@speednet.com</li>
                        <li><i class="fas fa-clock mr-2"></i>Пн-Пт: 8:00-20:00, Сб: 9:00-17:00</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-500 text-center cyber-text opacity-80">
                <p>&copy; {{ date('Y') }} SpeedNet. Всі права захищені. | <a href="#"
                                                                             class="hover:text-gray-400 transition-colors">Політика
                        конфіденційності</a> | <a href="#" class="hover:text-gray-400 transition-colors">Умови
                        використання</a></p>
            </div>
        </div>
    </footer>
</div>

@livewire('connection-request-form')

@livewireScripts

<script>

    window.openConnectionModal = function (tariffId = null) {

        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch('openModal', {tariffId: tariffId});
        } else {
            console.error('Livewire не знайдено');
        }
    };
</script>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });

                const menu = document.getElementById('mobile-menu');
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            } else {
                console.warn(`Element with ID ${targetId} not found`);
            }
        });
    });
</script>
</body>
</html>
