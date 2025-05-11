<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-extrabold cyber-heading sm:text-4xl">Наші послуги</h2>
        <p class="mt-4 text-lg cyber-text">Ми надаємо широкий спектр інтернет-послуг для задоволення ваших потреб.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($services as $service)
            <div class="cyber-card rounded-lg overflow-hidden transition-transform hover:scale-105 duration-300">
                @if($service->image)
                    <div class="adaptive-img-container">
                        <picture>
                            <!-- Мобільні пристрої -->
                            <source media="(max-width: 640px)"
                                    srcset="{{ asset('images/backgrounds/mobile/' . basename($service->image)) }}">
                            <!-- Планшети -->
                            <source media="(max-width: 1024px)"
                                    srcset="{{ asset('images/backgrounds/tablet/' . basename($service->image)) }}">
                            <!-- Десктопи -->
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}"
                                 class="adaptive-img adaptive-img-sm adaptive-img-md adaptive-img-lg"
                                 loading="lazy">
                        </picture>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        @if($service->icon)
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 rounded-full flex items-center justify-center">
                                    <img src="{{ $service->icon }}" alt="{{ $service->title }} icon" class="h-10 w-10">
                                </div>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold cyber-heading">{{ $service->title }}</h3>
                    </div>
                    <p class="cyber-text">{{ $service->description }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="cyber-text text-lg">На даний момент послуги недоступні.</p>
            </div>
        @endforelse
    </div>
</div>
