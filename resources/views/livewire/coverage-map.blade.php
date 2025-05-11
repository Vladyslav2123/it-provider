<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Перевірте покриття у вашому районі</h2>
            <p class="mt-4 text-lg text-white text-opacity-80">Дізнайтеся, чи доступна наша високошвидкісна інтернет-послуга у вашому місці.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Map Section -->
            <div class="bg-white bg-opacity-90 rounded-lg overflow-hidden shadow-lg h-96 relative">
                <!-- This would be replaced with an actual map in production -->
                <div class="absolute inset-0 bg-blue-50">
                    <!-- Simulated Map -->
                    <div class="w-full h-full relative overflow-hidden">
                        <!-- Map Background -->
                        <div class="absolute inset-0 bg-blue-50">
                            <!-- Grid Lines -->
                            @for ($i = 0; $i < 10; $i++)
                                <div class="absolute left-0 right-0 border-t border-blue-200" style="top: {{ $i * 10 }}%"></div>
                                <div class="absolute top-0 bottom-0 border-l border-blue-200" style="left: {{ $i * 10 }}%"></div>
                            @endfor
                        </div>

                        <!-- Coverage Areas -->
                        @foreach ($coverageAreas as $area)
                            <div class="absolute rounded-full bg-blue-500 bg-opacity-20 border-2 border-blue-500 transform -translate-x-1/2 -translate-y-1/2"
                                style="
                                    width: {{ min(100, $area->radius * 5) }}%;
                                    height: {{ min(100, $area->radius * 5) }}%;
                                    left: {{ (($area->longitude + 180) / 360) * 100 }}%;
                                    top: {{ (90 - $area->latitude) / 180 * 100 }}%;
                                "
                            ></div>
                        @endforeach

                        <!-- Selected Location Marker -->
                        @if ($selectedLocation)
                            <div class="absolute w-4 h-4 bg-red-500 rounded-full transform -translate-x-1/2 -translate-y-1/2 z-10"
                                style="
                                    left: {{ (($selectedLocation['longitude'] + 180) / 360) * 100 }}%;
                                    top: {{ (90 - $selectedLocation['latitude']) / 180 * 100 }}%;
                                "
                            ></div>
                        @endif
                    </div>
                </div>

                <!-- Map Attribution -->
                <div class="absolute bottom-2 right-2 text-xs text-gray-600 bg-white bg-opacity-75 px-2 py-1 rounded">
                    Візуалізація карти покриття
                </div>
            </div>

            <!-- Search and Results Section -->
            <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-6">
                <div class="mb-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Введіть вашу адресу</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                            type="text"
                            id="address"
                            wire:model.defer="searchQuery"
                            wire:keydown.enter="search"
                            class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            placeholder="вул. Хрещатик 1, Київ, Україна"
                        >
                        <button
                            wire:click="search"
                            class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Перевірити
                        </button>
                    </div>
                </div>

                <!-- Search Results -->
                @if (count($searchResults) > 0)
                    <div class="mb-6 border rounded-md divide-y">
                        @foreach ($searchResults as $index => $result)
                            <div class="p-3 hover:bg-gray-50 cursor-pointer" wire:click="selectLocation({{ $index }})">
                                {{ $result['address'] }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Coverage Result -->
                @if ($selectedLocation)
                    <div class="mt-6 p-4 rounded-md {{ $isInCoverageArea ? 'bg-green-50 border border-green-200' : 'bg-yellow-50 border border-yellow-200' }}">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                @if ($isInCoverageArea)
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium {{ $isInCoverageArea ? 'text-green-800' : 'text-yellow-800' }}">
                                    @if ($isInCoverageArea)
                                        Чудові новини! Ми надаємо послуги у вашому районі.
                                    @else
                                        На жаль, ми наразі не надаємо послуги за цією адресою.
                                    @endif
                                </h3>
                                <div class="mt-2 text-sm {{ $isInCoverageArea ? 'text-green-700' : 'text-yellow-700' }}">
                                    @if ($isInCoverageArea)
                                        <p>Ви знаходитесь в межах зони покриття "{{ $nearestCoverageArea->name }}". Найближча точка обслуговування знаходиться приблизно в {{ number_format($distance, 1) }} км від вас.</p>
                                    @else
                                        <p>Найближча зона обслуговування - "{{ $nearestCoverageArea->name }}", яка знаходиться приблизно в {{ number_format($distance, 1) }} км від вашого місцезнаходження.</p>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    @if ($isInCoverageArea)
                                        <button
                                            onclick="Livewire.dispatch('openModal')"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        >
                                            Підключитись зараз
                                        </button>
                                    @else
                                        <button
                                            onclick="Livewire.dispatch('openModal')"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        >
                                            Замовити підключення
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
