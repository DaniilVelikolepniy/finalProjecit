<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-xl w-full mx-auto bg-white p-6 rounded-2xl shadow-md">
            <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}"
                  method="POST" class="space-y-4">
                @csrf
                @if(isset($role))
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-gray-700 font-medium">Название роли</label>
                    <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}"
                           class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-300">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Описание роли</label>
                    <textarea name="description"
                              class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-300">{{ old('description', $role->description ?? '') }}</textarea>
                </div>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-transform transform hover:scale-105">
                    {{ isset($role) ? 'Обновить' : 'Сохранить' }}
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
