<div
    class="fixed inset-0 z-[100] {{ $showModal ? '' : 'hidden' }}"
    wire:keydown.escape="closeModal()"
    aria-modal="true"
    role="dialog"
>
    <!-- Modal Container -->
    <div class="fixed inset-0 z-[101] flex items-center justify-center overflow-y-auto overflow-x-hidden">
        <!-- Modal Content -->
        <div
            wire:click.outside="closeModal()"
            class="relative cyber-modal rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto transition-all duration-300 transform {{ $showModal ? 'opacity-100 scale-100' : 'opacity-0 scale-95' }}"
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-500">
                <h3 class="text-xl font-semibold cyber-heading">
                    Замовити підключення
                </h3>
                <button
                    type="button"
                    wire:click="closeModal()"
                    class="cyber-text hover:text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors"
                    aria-label="Закрити"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                @if($success)
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"></path>
                        </svg>
                        <h3 class="mt-2 text-xl font-semibold cyber-heading">Заявку надіслано!</h3>
                        <p class="mt-2 cyber-text">Дякуємо за ваш інтерес. Наша команда зв'яжеться з вами найближчим
                            часом для завершення процесу підключення.</p>
                        <div class="mt-6">
                            <button
                                type="button"
                                wire:click="closeModal()"
                                class="cyber-button inline-flex justify-center px-4 py-2 text-sm font-medium rounded-md focus:outline-none"
                            >
                                Закрити
                            </button>
                        </div>
                    </div>
                @else
                    <form wire:submit.prevent="submit" class="space-y-4">
                        <div>
                            <label for="modal-name" class="block text-sm font-medium cyber-text">ПІБ</label>
                            <input
                                type="text"
                                id="modal-name"
                                wire:model.blur="name"
                                class="cyber-input px-2 mt-1 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            >
                            @error('name') <span class="mt-1 text-sm text-red-400">{{ $message }}</span> @enderror

                        </div>

                        <div>
                            <label for="modal-email" class="block text-sm font-medium cyber-text">Email адреса</label>
                            <input
                                type="email"
                                id="modal-email"
                                wire:model.blur="email"
                                class="cyber-input px-2 mt-1 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            >
                            @error('email') <span class="mt-1 text-sm text-red-400">{{ $message }}</span> @enderror

                        </div>

                        <div>
                            <label for="modal-phone" class="block text-sm font-medium cyber-text">Номер телефону</label>
                            <input
                                type="tel"
                                id="modal-phone"
                                wire:model.blur="phone"
                                class="cyber-input px-2 mt-1 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            >
                            @error('phone') <span class="mt-1 text-sm text-red-400">{{ $message }}</span> @enderror

                        </div>

                        <div>
                            <label for="modal-address" class="block text-sm font-medium cyber-text">Адреса
                                підключення</label>
                            <input
                                type="text"
                                id="modal-address"
                                wire:model.blur="address"
                                class="cyber-input mt-1 px-2 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            >
                            @error('address') <span class="mt-1 text-sm text-red-400">{{ $message }}</span> @enderror

                        </div>

                        <div>
                            <label for="modal-tariff_id" class="block text-sm font-medium cyber-text">Оберіть тарифний
                                план</label>
                            <select
                                id="modal-tariff_id"
                                wire:model.blur="tariff_id"
                                class="cyber-input mt-1 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            >
                                <option value="">-- Оберіть план --</option>
                                @foreach($tariffs as $tariff)
                                    <option value="{{ $tariff->id }}">{{ $tariff->name }} -
                                        ${{ number_format($tariff->price, 2) }}/{{ $tariff->period }}</option>
                                @endforeach
                            </select>
                            @error('tariff_id') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="modal-message" class="block text-sm font-medium cyber-text">Додаткова інформація
                                (необов'язково)</label>
                            <textarea
                                id="modal-message"
                                wire:model.blur="message"
                                rows="3"
                                class="cyber-input px-2 mt-1 block w-full rounded-md shadow-sm focus:ring-gray-500 sm:text-sm"
                            ></textarea>
                            @error('message') <span class="mt-1 text-sm text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button
                                id="cancel"
                                type="button"
                                wire:click="closeModal()"
                                class="cyber-button-alt inline-flex justify-center px-4 py-2 text-sm font-medium rounded-md shadow-sm focus:outline-none"
                            >
                                Скасувати
                            </button>
                            <button
                                id="success"
                                type="submit"
                                class="cyber-button inline-flex justify-center px-4 py-2 text-sm font-medium rounded-md shadow-sm focus:outline-none"
                            >
                                Надіслати заявку
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
