<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h2 id="tariffs-heading" class="text-3xl font-extrabold cyber-heading sm:text-4xl">Наші тарифи</h2>
        <p class="mt-4 text-lg cyber-text">Виберіть план, який найкраще відповідає вашим потребам.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($tariffs as $tariff)
            <div
                class="cyber-card rounded-xl overflow-hidden transition-all hover:shadow-xl transform hover:scale-105 transition-transform duration-300 flex flex-col h-full">
                @if($tariff->is_popular)
                    <div class="bg-pink-600 text-white text-center py-2 font-semibold">
                        Найпопулярніший
                    </div>
                @endif
                <div class="p-6 {{ $tariff->is_popular ? '' : 'pt-10' }} flex flex-col h-full">
                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold cyber-heading mb-4">{{ $tariff->name }}</h3>
                        <div class="flex items-baseline mb-6">
                            <span class="text-5xl font-extrabold cyber-text">${{ number_format($tariff->price, 2) }}</span>
                            <span class="cyber-text opacity-80 ml-1">/ {{ $tariff->period }}</span>
                        </div>
                        <p class="cyber-text mb-6">{{ $tariff->description }}</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="cyber-text">Speed: <strong>{{ $tariff->speed }}</strong></span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="cyber-text">Безлімітний трафік</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="cyber-text">Підтримка 24/7</span>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-auto">
                        <button
                            id="tariff-{{ $tariff->id }}"
                            onclick="Livewire.dispatch('openModal', { tariffId: {{ $tariff->id }} })"
                            class="cyber-button w-full py-3 px-4 rounded-md font-semibold transition-colors focus:outline-none"
                        >
                            Підключитись
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="cyber-text text-lg">На даний момент тарифи недоступні.</p>
            </div>
        @endforelse
    </div>
</div>
