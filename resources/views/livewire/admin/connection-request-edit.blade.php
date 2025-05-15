<div>
    @if($successMessage)
        <div class="mb-4 p-4 bg-green-800/20 border border-green-600 rounded-md text-green-400">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ $successMessage }}</span>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium">ПІБ</label>
                <input type="text" id="name" wire:model="request.name"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                @error('request.name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" wire:model="request.email"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                @error('request.email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium">Телефон</label>
                <input type="text" id="phone" wire:model="request.phone"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                @error('request.phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium">Адреса</label>
                <input type="text" id="address" wire:model="request.address"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                @error('request.address') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tariff_id" class="block text-sm font-medium">Тариф</label>
                <select id="tariff_id" wire:model="request.tariff_id"
                        class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                    <option value="">Виберіть тариф</option>
                    @foreach($tariffs as $tariff)
                        <option value="{{ $tariff->id }}">{{ $tariff->name }} - {{ number_format($tariff->price, 2) }} грн / {{ $tariff->period }}</option>
                    @endforeach
                </select>
                @error('request.tariff_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium">Статус</label>
                <select id="status" wire:model="request.status"
                        class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2">
                    <option value="new">Нова</option>
                    <option value="processing">В обробці</option>
                    <option value="completed">Завершена</option>
                    <option value="cancelled">Скасована</option>
                </select>
                @error('request.status') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium">Повідомлення від клієнта</label>
            <textarea id="message" wire:model="request.message" rows="4"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm px-3 py-2"></textarea>
            @error('request.message') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.connection-requests') }}" class="admin-dark-button-alt px-4 py-2 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i> Назад до списку
            </a>
            <button type="submit" class="admin-dark-button px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-save mr-2"></i> Зберегти зміни
            </button>
        </div>
    </form>
</div>
