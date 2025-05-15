<div>
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-xl font-semibold">Список заявок на підключення</h2>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <div class="flex-1 md:flex-none">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Пошук за ім'ям, email, телефоном..."
                       class="admin-dark-input w-full md:w-64 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="flex-1 md:flex-none">
                <select wire:model.live="statusFilter" class="admin-dark-input w-full md:w-48 rounded-md shadow-sm px-3 py-2">
                    <option value="">Всі статуси</option>
                    <option value="new">Нові</option>
                    <option value="processing">В обробці</option>
                    <option value="completed">Завершені</option>
                    <option value="cancelled">Скасовані</option>
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
                    Клієнт
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Контакти
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Адреса
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Тариф
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
            @forelse($requests as $request)
                <tr class="hover:bg-gray-700/50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $request->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">{{ $request->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">{{ $request->email }}</div>
                        <div class="text-sm text-gray-400">{{ $request->phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">{{ Str::limit($request->address, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">{{ $request->tariff ? $request->tariff->name : 'Не вказано' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $request->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select wire:change="updateStatus({{ $request->id }}, $event.target.value)" 
                                class="admin-dark-input text-sm rounded-md shadow-sm px-2 py-1">
                            <option value="new" {{ $request->status === 'new' ? 'selected' : '' }}>
                                Нова
                            </option>
                            <option value="processing" {{ $request->status === 'processing' ? 'selected' : '' }}>
                                В обробці
                            </option>
                            <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>
                                Завершена
                            </option>
                            <option value="cancelled" {{ $request->status === 'cancelled' ? 'selected' : '' }}>
                                Скасована
                            </option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.connection-requests.edit', $request) }}" class="admin-dark-link hover:text-blue-400 mr-3">
                            <i class="fas fa-edit mr-1"></i> Деталі
                        </a>
                        <button wire:click="deleteRequest({{ $request->id }})"
                                wire:confirm="Ви впевнені, що хочете видалити цю заявку?"
                                class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash-alt mr-1"></i> Видалити
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <i class="fas fa-info-circle mr-2"></i> Заявки не знайдено
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $requests->links() }}
    </div>
</div>
