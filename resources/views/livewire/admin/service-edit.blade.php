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
            <input type="text" id="title" wire:model.defer="service.title"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('service.title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">Опис</label>
            <textarea id="description" wire:model.defer="service.description" rows="5"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('service.description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="order" class="block text-sm font-medium">Порядок</label>
                <input type="number" id="order" wire:model.defer="service.order"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('service.order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="active" wire:model.defer="service.active"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
                <label for="active" class="ml-2 block text-sm">Активний</label>
                @error('service.active') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Поточне зображення</label>
                @if(isset($service['image']) && $service['image'])
                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="mt-2 h-48 w-auto object-cover rounded">
                @else
                    <div class="mt-2 h-48 w-full bg-gray-700 flex items-center justify-center rounded">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium">Поточна іконка</label>
                @if(isset($service['icon']) && $service['icon'])
                    <img src="{{ asset($service['icon']) }}" alt="{{ $service['title'] }} icon" class="mt-2 h-16 w-auto rounded bg-gray-800 p-2">
                @else
                    <div class="mt-2 h-16 w-16 bg-gray-700 flex items-center justify-center rounded">
                        <i class="fas fa-icons text-gray-400 text-xl"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="newImage" class="block text-sm font-medium">Нове зображення</label>
                <input type="file" id="newImage" wire:model="newImage"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('newImage') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                @if ($newImage)
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">Попередній перегляд:</p>
                        <img src="{{ $newImage->temporaryUrl() }}" class="mt-1 h-48 w-auto object-cover rounded">
                    </div>
                @endif
            </div>

            <div>
                <label for="newIcon" class="block text-sm font-medium">Нова іконка</label>
                <input type="file" id="newIcon" wire:model="newIcon"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('newIcon') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                @if ($newIcon)
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">Попередній перегляд:</p>
                        <img src="{{ $newIcon->temporaryUrl() }}" class="mt-1 h-16 w-auto rounded bg-gray-800 p-2">
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="admin-dark-button-primary inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium">
                <i class="fas fa-save mr-2"></i> Зберегти зміни
            </button>
        </div>
    </form>
</div>
