<div>
    <div class="mb-6">
        <a href="{{ route('admin.tariffs') }}" class="admin-dark-link hover:text-blue-400 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад до списку тарифів
        </a>
    </div>

    @if($successMessage)
        <div class="mb-4 bg-green-900/30 border border-green-700 text-green-400 px-4 py-3 rounded"
             x-data="{show: true}"
             x-show="show"
             x-init="setTimeout(() => { show = false; $wire.set('successMessage', ''); }, 2000)">
            <i class="fas fa-check-circle mr-2"></i> {{ $successMessage }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium">Назва тарифу</label>
            <input type="text" id="name" wire:model.defer="name"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">Опис</label>
            <textarea id="description" wire:model.defer="description" rows="3"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="price" class="block text-sm font-medium">Ціна</label>
                <input type="number" id="price" wire:model.defer="price" step="0.01"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('price') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="period" class="block text-sm font-medium">Період</label>
                <select id="period" wire:model.defer="period"
                        class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="місяць">Місяць</option>
                    <option value="рік">Рік</option>
                    <option value="день">День</option>
                </select>
                @error('period') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="speed" class="block text-sm font-medium">Швидкість</label>
                <input type="text" id="speed" wire:model.defer="speed"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('speed') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="order" class="block text-sm font-medium">Порядок</label>
                <input type="number" id="order" wire:model.defer="order"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_popular" wire:model.defer="is_popular"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
                <label for="is_popular" class="ml-2 block text-sm">Популярний тариф</label>
                @error('is_popular') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="active" wire:model.defer="active"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
                <label for="active" class="ml-2 block text-sm">Активний</label>
                @error('active') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="admin-dark-button px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-save mr-2"></i> Створити тариф
            </button>
        </div>
    </form>
</div>
