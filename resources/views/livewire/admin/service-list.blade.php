<div>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Список послуг</h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.services.create') }}" class="admin-dark-button px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i> Створити
            </a>
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
                    Зображення
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Назва
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Порядок
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Активний
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                    Дії
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
            @forelse($services as $service)
                <tr class="hover:bg-gray-700/50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $service->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="h-16 w-auto object-cover rounded">
                        @else
                            <div class="h-16 w-16 bg-gray-700 flex items-center justify-center rounded">
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">{{ $service->title }}</div>
                        <div class="text-sm text-gray-400">{{ Str::limit($service->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" wire:change="updateOrder({{ $service->id }}, $event.target.value)"
                               value="{{ $service->order }}" class="admin-dark-input w-16 rounded-md shadow-sm">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="toggleActive({{ $service->id }})" class="focus:outline-none">
                            @if($service->active)
                                <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full admin-dark-badge-success">
                                    <i class="fas fa-check-circle mr-1"></i> Активний
                                </span>
                            @else
                                <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full admin-dark-badge-danger">
                                    <i class="fas fa-times-circle mr-1"></i> Неактивний
                                </span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.services.edit', $service) }}" class="admin-dark-link hover:text-blue-400 mr-3">
                            <i class="fas fa-edit mr-1"></i> Редагувати
                        </a>
                        <button wire:click="deleteService({{ $service->id }})"
                                wire:confirm="Ви впевнені, що хочете видалити цю послугу?"
                                class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash-alt mr-1"></i> Видалити
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <i class="fas fa-info-circle mr-2"></i> Послуги не знайдено
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
