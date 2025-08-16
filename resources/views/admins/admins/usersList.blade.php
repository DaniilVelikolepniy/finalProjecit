<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @if($users->isNotEmpty())
                @foreach($users as $user)
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col md:flex-row justify-between items-start md:items-center hover:shadow-lg transition-shadow duration-300">
                    <div class="flex flex-col space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @forelse($user->roles as $role)
                            <form method="POST" action="{{ route('users.removeRole') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <button type="submit"
                                    class="px-2 py-1 text-sm rounded bg-blue-100 text-blue-800 hover:bg-red-500 hover:text-white transition duration-200">
                                    {{ $role->name }} ✖
                                </button>
                            </form>
                            @empty
                            <span class="px-2 py-1 text-sm rounded bg-gray-100 text-gray-600">Нет ролей</span>
                            @endforelse
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-3 mt-4 md:mt-0" x-data="{ open: false }">
                        <a href="{{ route('u.info', ['id' => $user->id]) }}"
                            class="px-4 py-2 rounded bg-green-500 text-white font-medium transform transition duration-200 hover:bg-green-600 hover:scale-105 active:scale-95">
                            Просмотр
                        </a>
                        <div class="relative">
                            <button @click="open = !open"
                                class="px-4 py-2 rounded bg-blue-500 text-white font-medium transform transition duration-200 hover:bg-blue-600 hover:scale-105 active:scale-95">
                                Присвоить роль
                            </button>
                            <div x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50 origin-top-right">
                                @foreach($roles as $role)
                                <form method="POST" action="{{ route('users.assignRole') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
                                        {{ $role->name }}
                                    </button>
                                </form>
                                @endforeach
                            </div>
                        </div>
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
                            class="border rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500"
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