<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ролевая модель</h1>
                <p class="mt-2 text-gray-500">Управление ролями пользователей системы</p>
            </div>
            <a href="{{ route('roles.create') }}"
                class="inline-flex items-center gap-1.5 px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-xl shadow-sm hover:bg-primary-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Добавить роль
            </a>
        </div>

        @php
            $roleLabels = [
                'admin' => 'Администратор',
                'editor' => 'Редактор',
                'client' => 'Клиент',
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($roles as $role)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center
                        @if($role->name === 'admin') bg-red-100 @elseif($role->name === 'editor') bg-amber-100 @else bg-primary-100 @endif">
                        @if($role->name === 'admin')
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        @elseif($role->name === 'editor')
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">{{ $roleLabels[$role->name] ?? ucfirst($role->name) }}</h2>
                    </div>
                </div>

                @if($role->description)
                    <p class="text-sm text-gray-500 mb-4">{{ $role->description }}</p>
                @endif

                <div class="flex gap-2 pt-4 border-t border-gray-100">
                    <a href="{{ route('roles.edit', $role) }}"
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-primary-700 bg-primary-50 rounded-lg hover:bg-primary-100 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Редактировать
                    </a>

                    <form action="{{ route('roles.destroy', $role) }}" method="POST"
                          onsubmit="return confirm('Вы уверены, что хотите удалить эту роль?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
