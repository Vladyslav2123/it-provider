<div>
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-xl font-semibold">Список відгуків</h2>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <div class="flex-1 md:flex-none">
                <select wire:model.live="statusFilter" class="admin-dark-input w-full md:w-48 rounded-md shadow-sm px-3 py-2">
                    <option value="">Всі статуси</option>
                    <option value="approved">Схвалені</option>
                    <option value="pending">Очікують схвалення</option>
                </select>
            </div>
            <div class="flex-1 md:flex-none">
                <select wire:model.live="ratingFilter" class="admin-dark-input w-full md:w-48 rounded-md shadow-sm px-3 py-2">
                    <option value="">Всі рейтинги</option>
                    <option value="5">5 зірок</option>
                    <option value="4">4 зірки</option>
                    <option value="3">3 зірки</option>
                    <option value="2">2 зірки</option>
                    <option value="1">1 зірка</option>
                </select>
            </div>
            <button wire:click="$refresh" class="admin-dark-button px-4 py-2 rounded hover:bg-gray-700 flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Оновити
            </button>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full divide-y divide-gray-700 admin-dark-table">
            <thead>
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    ID
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Автор
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Відгук
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Рейтинг
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Дата
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Статус
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Дії
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
            @forelse($reviews as $review)
                <tr class="hover:bg-gray-700/50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $review->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">{{ $review->name }}</div>
                        @if($review->email)
                            <div class="text-sm text-gray-400">{{ $review->email }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">{{ Str::limit($review->content, 100) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                        {{ $review->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="toggleApproved({{ $review->id }})" class="focus:outline-none">
                            @if($review->approved)
                                <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full admin-dark-badge-success">
                                    <i class="fas fa-check-circle mr-1"></i> Схвалено
                                </span>
                            @else
                                <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full admin-dark-badge-warning">
                                    <i class="fas fa-clock mr-1"></i> Очікує схвалення
                                </span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.reviews.edit', $review) }}" class="admin-dark-link hover:text-blue-400 mr-3">
                            <i class="fas fa-edit mr-1"></i> Редагувати
                        </a>
                        <button wire:click="deleteReview({{ $review->id }})"
                                wire:confirm="Ви впевнені, що хочете видалити цей відгук?"
                                class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash-alt mr-1"></i> Видалити
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <i class="fas fa-info-circle mr-2"></i> Відгуки не знайдено
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 admin-dark-card p-2 rounded-lg">
        {{ $reviews->links() }}
    </div>
</div>
