<div>
    <div class="mb-6">
        <a href="{{ route('admin.services') }}" class="admin-dark-link hover:text-blue-400 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад до списку послуг
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
            <label for="title" class="block text-sm font-medium">Назва послуги</label>
            <input type="text" id="title" wire:model.defer="title"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">Опис</label>
            <textarea id="description" wire:model.defer="description" rows="3"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="order" class="block text-sm font-medium">Порядок</label>
                <input type="number" id="order" wire:model.defer="order"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="active" wire:model.defer="active"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
                <label for="active" class="ml-2 block text-sm">Активний</label>
                @error('active') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image" class="block text-sm font-medium">Зображення</label>
                <input type="file" id="image" wire:model="image"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                @if ($image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">Попередній перегляд:</p>
                        <img src="{{ $image->temporaryUrl() }}" class="mt-1 h-48 w-auto object-cover rounded">
                    </div>
                @endif
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium">Іконка</label>
                <input type="file" id="icon" wire:model="icon"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('icon') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                @if ($icon)
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">Попередній перегляд:</p>
                        <img src="{{ $icon->temporaryUrl() }}" class="mt-1 h-16 w-auto rounded bg-gray-800 p-2">
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="admin-dark-button px-4 py-2 rounded hover:bg-blue-600">
                <i class="fas fa-save mr-2"></i> Створити послугу
            </button>
        </div>
    </form>
</div>
