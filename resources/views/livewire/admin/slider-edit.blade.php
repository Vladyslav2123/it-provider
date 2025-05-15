<div>
    <div class="mb-6">
        <a href="{{ route('admin.sliders') }}" class="admin-dark-link hover:text-blue-400 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад до списку слайдерів
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
            <label for="title" class="block text-sm font-medium">Заголовок</label>
            <input type="text" id="title" wire:model.defer="slider.title"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('slider.title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">Опис</label>
            <textarea id="description" wire:model.defer="slider.description" rows="3"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('slider.description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="button_text" class="block text-sm font-medium">Текст кнопки</label>
                <input type="text" id="button_text" wire:model.defer="slider.button_text"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('slider.button_text') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="button_url" class="block text-sm font-medium">URL кнопки</label>
                <input type="text" id="button_url" wire:model.defer="slider.button_url"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('slider.button_url') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="order" class="block text-sm font-medium">Порядок</label>
                <input type="number" id="order" wire:model.defer="slider.order"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('slider.order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="active" wire:model.defer="slider.active"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
                <label for="active" class="ml-2 block text-sm">Активний</label>
                @error('slider.active') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Поточне зображення</label>
            @if(isset($slider['image']) && $slider['image'])
                <img src="{{ asset($slider['image']) }}" alt="{{ $slider['title'] }}" class="mt-2 h-48 w-auto object-cover rounded">
            @else
                <div class="mt-2 h-48 w-full bg-gray-700 flex items-center justify-center rounded">
                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                </div>
            @endif
        </div>

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

        <div class="flex justify-end">
            <button type="submit"
                    class="admin-dark-button-primary inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium">
                <i class="fas fa-save mr-2"></i> Зберегти зміни
            </button>
        </div>
    </form>
</div>
