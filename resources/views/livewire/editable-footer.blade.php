<footer class="cyber-footer py-12 cyber-grid-lines">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($successMessage)
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ $successMessage }}
            </div>
            <script>
                setTimeout(() => {
                @this.set('successMessage', '')

                }, 2000);
            </script>
        @endif

        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="mb-4 flex justify-end">
                <button wire:click="toggleEdit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    {{ $isEditing ? 'Скасувати' : 'Редагувати футер' }}
                </button>

                @if($isEditing)
                    <button wire:click="save"
                            class="ml-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                        Зберегти зміни
                    </button>
                @endif
            </div>
        @endif

        @if($isEditing)
            <form wire:submit.prevent="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <div class="mb-4">
                            <img src="{{ asset('images/logo/speednet-logo.svg') }}" alt="SpeedNet Logo"
                                 class="h-10 mb-2">
                        </div>
                        <div class="mb-4">
                            <label for="company_description" class="block text-sm font-medium text-gray-300 mb-1">Опис
                                компанії</label>
                            <textarea id="company_description" wire:model="settings.company_description" rows="4"
                                      class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            @error('settings.company_description') <span
                                class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label for="facebook_url" class="block text-sm font-medium text-gray-300 mb-1">Facebook
                                    URL</label>
                                <input type="text" id="facebook_url" wire:model="settings.facebook_url"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.facebook_url') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-300 mb-1">Twitter
                                    URL</label>
                                <input type="text" id="twitter_url" wire:model="settings.twitter_url"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.twitter_url') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="instagram_url" class="block text-sm font-medium text-gray-300 mb-1">Instagram
                                    URL</label>
                                <input type="text" id="instagram_url" wire:model="settings.instagram_url"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.instagram_url') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4 cyber-heading">Швидкі посилання</h3>
                        <p class="text-sm text-gray-400 mb-4">Швидкі посилання налаштовуються автоматично на основі
                            розділів сайту.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4 cyber-heading">Контакти</h3>
                        <div class="space-y-3">
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-300 mb-1">Адреса</label>
                                <input type="text" id="address" wire:model="settings.address"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.address') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Телефон</label>
                                <input type="text" id="phone" wire:model="settings.phone"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.phone') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                                <input type="email" id="email" wire:model="settings.email"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.email') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="working_hours" class="block text-sm font-medium text-gray-300 mb-1">Години
                                    роботи</label>
                                <input type="text" id="working_hours" wire:model="settings.working_hours"
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('settings.working_hours') <span
                                    class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-500">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="copyright_text" class="block text-sm font-medium text-gray-300 mb-1">Текст
                                копірайту</label>
                            <input type="text" id="copyright_text" wire:model="settings.copyright_text"
                                   class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('settings.copyright_text') <span
                                class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="privacy_policy_url" class="block text-sm font-medium text-gray-300 mb-1">URL
                                політики конфіденційності</label>
                            <input type="text" id="privacy_policy_url" wire:model="settings.privacy_policy_url"
                                   class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('settings.privacy_policy_url') <span
                                class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="terms_url" class="block text-sm font-medium text-gray-300 mb-1">URL умов
                                використання</label>
                            <input type="text" id="terms_url" wire:model="settings.terms_url"
                                   class="w-full bg-gray-800 border border-gray-600 rounded-md text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('settings.terms_url') <span
                                class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="mb-4">
                        <img src="{{ asset('/storage/images/logo/speednet-logo.svg') }}" alt="SpeedNet Logo"
                             class="h-10 mb-2">
                    </div>
                    <p class="cyber-text">{{ $settings['company_description'] }}</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="{{ $settings['facebook_url'] }}"
                           class="cyber-text hover:text-gray-400 transition-colors" aria-label="Facebook"
                           rel="noopener noreferrer">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="{{ $settings['twitter_url'] }}"
                           class="cyber-text hover:text-gray-400 transition-colors" aria-label="Twitter"
                           rel="noopener noreferrer">
                            <i class="fab fa-twitter" aria-hidden="true"></i>
                            <span class="sr-only">Twitter</span>
                        </a>
                        <a href="{{ $settings['instagram_url'] }}"
                           class="cyber-text hover:text-gray-400 transition-colors" aria-label="Instagram"
                           rel="noopener noreferrer">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 cyber-heading">Швидкі посилання</h3>
                    <ul class="space-y-2">
                        <li><a href="#services" class="cyber-text hover:text-gray-400 transition-colors">Послуги</a>
                        </li>
                        <li><a href="#tariffs" class="cyber-text hover:text-gray-400 transition-colors">Тарифи</a></li>
                        <li><a href="#reviews" class="cyber-text hover:text-gray-400 transition-colors">Відгуки</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 cyber-heading">Контакти</h3>
                    <ul class="space-y-2 cyber-text">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>{{ $settings['address'] }}</li>
                        <li><i class="fas fa-phone mr-2"></i>{{ $settings['phone'] }}</li>
                        <li><i class="fas fa-envelope mr-2"></i>{{ $settings['email'] }}</li>
                        <li><i class="fas fa-clock mr-2"></i>{{ $settings['working_hours'] }}</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-500 text-center cyber-text opacity-80">
                <p>&copy; {{ date('Y') }} {{ $settings['copyright_text'] }} | <a
                        href="{{ $settings['privacy_policy_url'] }}"
                        class="hover:text-gray-400 transition-colors">Політика
                        конфіденційності</a> | <a href="{{ $settings['terms_url'] }}"
                                                  class="hover:text-gray-400 transition-colors">Умови
                        використання</a></p>
            </div>
        @endif
    </div>
</footer>
