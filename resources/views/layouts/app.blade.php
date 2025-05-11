<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Internet Provider') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="container mx-auto">
                <nav class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold text-blue-600">
                            <i class="fas fa-wifi mr-2"></i>SpeedNet
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-blue-600">Home</a>
                        <a href="#services" class="text-gray-700 hover:text-blue-600">Services</a>
                        <a href="#tariffs" class="text-gray-700 hover:text-blue-600">Tariffs</a>
                        <a href="#reviews" class="text-gray-700 hover:text-blue-600">Reviews</a>
                    </div>
                    <div>
                        <button
                            onclick="Livewire.dispatch('openModal')"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                        >
                            Підключитись
                        </button>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">SpeedNet</h3>
                        <p class="mb-4">Providing high-speed internet solutions for homes and businesses.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#home" class="hover:text-blue-400">Home</a></li>
                            <li><a href="#services" class="hover:text-blue-400">Services</a></li>
                            <li><a href="#tariffs" class="hover:text-blue-400">Tariffs</a></li>
                            <li><a href="#reviews" class="hover:text-blue-400">Reviews</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                        <ul class="space-y-2">
                            <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Internet Street, Digital City</li>
                            <li><i class="fas fa-phone mr-2"></i> (123) 456-7890</li>
                            <li><i class="fas fa-envelope mr-2"></i> info@speednet.com</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p>&copy; {{ date('Y') }} SpeedNet. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @livewire('connection-request-form')

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>
    <!-- Alpine.js Focus Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.13.0/dist/cdn.min.js"></script>
</body>
</html>
