<div class="relative w-full h-[600px] overflow-hidden bg-gray-900 cyber-grid-lines">
    @if(count($items) > 0)
        <!-- Current Active Slide -->
        <div
            class="absolute inset-0 w-full h-full transition-opacity duration-500 ease-in-out"
        >
            <picture>
                <!-- Мобільні пристрої -->
                <source media="(max-width: 640px)" srcset="{{ asset('images/backgrounds/mobile/' . basename($items[$activeSlide]->image)) }}">
                <!-- Планшети -->
                <source media="(max-width: 1024px)" srcset="{{ asset('images/backgrounds/tablet/' . basename($items[$activeSlide]->image)) }}">
                <!-- Десктопи -->
                <img src="{{ asset($items[$activeSlide]->image) }}" alt="{{ $items[$activeSlide]->title }}" class="w-full h-full object-cover">
            </picture>

            <div class="absolute inset-0 flex items-center justify-center">
                <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div
                        class="flex flex-col items-center justify-center p-6">
                        <h1 class="text-4xl font-extrabold tracking-tight cyber-heading sm:text-5xl md:text-6xl text-shadow">
                            {{ $items[$activeSlide]->title }}
                        </h1>
                        @if($items[$activeSlide]->description)
                            <p class="mt-6 max-w-xl mx-auto text-xl cyber-text text-shadow">
                                {{ $items[$activeSlide]->description }}
                            </p>
                        @endif
                        <div class="mt-8 h-14 flex items-center justify-center"> <!-- Fixed height container -->
                            @if($items[$activeSlide]->button_text && $items[$activeSlide]->button_url)
                                <a href="{{ $items[$activeSlide]->button_url }}"
                                   class="cyber-button inline-block px-6 py-3 text-base font-medium rounded-md focus:outline-none transition duration-150 ease-in-out">
                                    {{ $items[$activeSlide]->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <div
            wire:click="prevSlide"
            class="absolute left-4 md:left-6 lg:left-8 top-1/2 transform -translate-y-1/2 cyber-button p-2 sm:p-3 rounded-full focus:outline-none cursor-pointer z-20 transition duration-150 ease-in-out slider-nav-arrow"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </div>
        <div
            wire:click="nextSlide"
            class="absolute right-4 md:right-6 lg:right-8 top-1/2 transform -translate-y-1/2 cyber-button p-2 sm:p-3 rounded-full focus:outline-none cursor-pointer z-20 transition duration-150 ease-in-out slider-nav-arrow"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>

        <!-- Dots Navigation -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-3 z-10">
            @foreach($items as $index => $item)
                <div
                    wire:click="goToSlide({{ $index }})"
                    class="h-4 w-4 rounded-full {{ $index === $activeSlide ? 'bg-gray-500' : 'bg-white' }} hover:bg-gray-400 focus:outline-none cursor-pointer transition duration-150 ease-in-out"
                ></div>
            @endforeach
        </div>
    @else
        <div class="w-full h-full flex items-center justify-center cyber-card">
            <p class="cyber-text text-xl">Слайдери недоступні</p>
        </div>
    @endif
</div>
