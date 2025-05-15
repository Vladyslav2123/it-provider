<div>
    <div class="mb-6">
        <a href="{{ route('admin.reviews') }}" class="admin-dark-link hover:text-blue-400 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Назад до списку відгуків
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
            <label for="name" class="block text-sm font-medium">Ім'я автора</label>
            <input type="text" id="name" wire:model.defer="review.name"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('review.name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" wire:model.defer="review.email"
                   class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('review.email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium">Текст відгуку</label>
            <textarea id="content" wire:model.defer="review.content" rows="4"
                      class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('review.content') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium">Рейтинг</label>
            <select id="rating" wire:model.defer="review.rating"
                    class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="1">1 зірка</option>
                <option value="2">2 зірки</option>
                <option value="3">3 зірки</option>
                <option value="4">4 зірки</option>
                <option value="5">5 зірок</option>
            </select>
            @error('review.rating') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="approved" wire:model.defer="review.approved"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-700 bg-gray-700 rounded">
            <label for="approved" class="ml-2 block text-sm">Схвалено</label>
            @error('review.approved') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Поточний аватар</label>
                @if(isset($review['avatar']) && $review['avatar'])
                    <img src="{{ asset($review['avatar']) }}" alt="{{ $review['name'] }}" class="mt-2 h-24 w-24 rounded-full object-cover border border-gray-700">
                @else
                    <div class="mt-2 h-24 w-24 rounded-full bg-gray-700 flex items-center justify-center border border-gray-600">
                        <i class="fas fa-user text-gray-400 text-xl"></i>
                    </div>
                @endif
            </div>

            <div>
                <label for="newAvatar" class="block text-sm font-medium">Новий аватар</label>
                <input type="file" id="newAvatar" wire:model="newAvatar"
                       class="admin-dark-input mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600">
                @error('newAvatar') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                @if ($newAvatar)
                    <div class="mt-2">
                        <p class="text-sm text-gray-400">Попередній перегляд:</p>
                        <img src="{{ $newAvatar->temporaryUrl() }}" class="mt-1 h-24 w-24 rounded-full object-cover border border-gray-700">
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
