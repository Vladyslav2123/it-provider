<div class="max-w-2xl mx-auto">
    @if($success)
        <div class="bg-gray-900 bg-opacity-30 border-l-4 border-gray-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 cyber-text">
                        Дякуємо за ваш відгук! Він буде опублікований після модерації.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6 cyber-card p-6 rounded-lg">
        <div>
            <label for="name" class="block text-sm font-medium cyber-text">Ваше ім'я</label>
            <div class="mt-1">
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="cyber-input shadow-sm focus:ring-gray-500 block w-full sm:text-sm rounded-md"
                >
            </div>
            @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium cyber-text">Email (необов'язково)</label>
            <div class="mt-1">
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="cyber-input shadow-sm focus:ring-gray-500 block w-full sm:text-sm rounded-md"
                >
            </div>
            @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="rating" class="block text-sm font-medium cyber-text">Оцінка</label>
            <div class="mt-1 flex items-center">
                @for($i = 1; $i <= 5; $i++)
                    <button
                        type="button"
                        wire:click="$set('rating', {{ $i }})"
                        class="h-8 w-8 focus:outline-none"
                    >
                        <svg class="h-6 w-6 {{ $i <= $rating ? 'text-gray-300' : 'text-gray-600' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                @endfor
            </div>
            @error('rating') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium cyber-text">Ваш відгук</label>
            <div class="mt-1">
                <textarea
                    id="content"
                    wire:model="content"
                    rows="4"
                    class="cyber-input shadow-sm focus:ring-gray-500 block w-full sm:text-sm rounded-md"
                ></textarea>
            </div>
            @error('content') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <button
                type="submit"
                class="cyber-button w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium focus:outline-none"
            >
                Надіслати відгук
            </button>
        </div>
    </form>
</div>
