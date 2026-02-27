<x-layouts.app>
    @php
        $roleLabels = ['admin' => 'Администратор', 'editor' => 'Редактор', 'client' => 'Клиент'];
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @if($users->isNotEmpty())
                @foreach($users as $user)
                <div
                    class="bg-white p-6 rounded-lg shadow-md flex flex-col md:flex-row justify-between items-start md:items-center hover:shadow-lg transition-shadow duration-300">
                    <div class="flex flex-col space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @forelse($user->roles as $role)
                            <form method="POST" action="{{ route('u.removeRole') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <button type="submit"
                                    class="px-2 py-1 text-sm rounded bg-gray-200 text-gray-700 hover:bg-rose-100 hover:text-rose-600 transition">
                                    {{ $roleLabels[$role->name] ?? ucfirst($role->name) }}
                                </button>
                            </form>
                            @empty
                            <span
                                class="px-2 py-1 text-sm rounded bg-gray-100 text-gray-500">Нет ролей</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                        <a href="{{ route('u.info', ['id' => $user->id]) }}"
                            class="px-4 py-2 rounded bg-emerald-500 text-white font-medium transform transition duration-200 hover:bg-emerald-600 hover:scale-105 active:scale-95">
                            Просмотр
                        </a>
                        @unless(auth()->id() === $user->id)
                        <form method="POST" action="{{ route('u.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 rounded bg-gray-400 text-white font-medium transform transition duration-200 hover:bg-gray-500 hover:scale-105 active:scale-95"
                                onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                                Удалить
                            </button>
                        </form>
                        @endunless
                    </div>
                </div>
                @endforeach
                @else
                <h1 class="text-lg md:text-xl font-semibold text-gray-800">Нет пользователей</h1>
                @endif
            </div>
            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    {{ $users->links() }}
                </div>
                <div>
                    <form method="GET" action="{{ route('usersListForAdmin') }}" class="flex items-center gap-2">
                        <label for="perPage" class="text-sm text-gray-700">Показывать:</label>
                        <select id="perPage" name="perPage"
                            class="border rounded px-2 py-1 text-sm focus:ring-2 focus:ring-indigo-500"
                            onchange="this.form.submit()">
                            @foreach([10,20,30,40,50] as $size)
                            <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-sm text-gray-500">на страницу</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
