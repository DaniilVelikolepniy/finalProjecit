<x-layouts.app>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Роли</h1>
        <a href="{{ route('roles.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
            ➕ Добавить роль
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($roles as $role)
        <div class="p-4 bg-white shadow-lg rounded-2xl">
            <h2 class="text-xl font-semibold mb-2">{{ $role->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $role->description }}</p>

            <div class="flex gap-2">
                <a href="{{ route('roles.edit', $role) }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-3 rounded transition hover:scale-105">✏️ Редактировать</a>

                <form action="{{ route('roles.destroy', $role) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition hover:scale-105">
                        🗑️ Удалить
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-layouts.app>