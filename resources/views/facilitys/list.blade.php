<x-layouts.app>
    <div class="max-w-7xl mx-auto p-6">

        <!-- Верхняя панель: Назад + Создать новое -->
        <div class="flex items-center justify-between mb-6">

            <!-- Кнопка назад -->
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-lg shadow transition">
                ← Назад
            </a>

            <!-- Кнопка создания нового удобства -->
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('f.create') }}"
                   class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white rounded-xl shadow
                          hover:bg-indigo-700 hover:shadow-md transition-all duration-150">
                    + Создать новое
                </a>
            @endif
        </div>

        <!-- Сетка удобств -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($facilites as $facility)
                <div
                    class="relative bg-white rounded-[15px] p-4 flex flex-col justify-between
                           transition-all duration-150 ease-in-out
                           hover:rounded-[10px] hover:translate-y-1"
                    style="box-shadow: 10px 10px 10px rgba(0,0,0,0.1);"
                    onmouseover="this.style.boxShadow='5px 5px 5px rgba(0,0,0,0.05)';"
                    onmouseout="this.style.boxShadow='10px 10px 10px rgba(0,0,0,0.1)';"
                >

                    <!-- Название удобства -->
                    <h2 class="text-lg font-semibold mb-4">{{ $facility->name }}</h2>

                    <!-- Действия -->
                    <div class="flex justify-between mt-auto space-x-2">
                        <a href="{{ route('f.edit', $facility->id) }}"
                           class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded shadow text-center transition-colors duration-150">
                            Изменить
                        </a>

                        <form action="{{ route('f.destroy', $facility->id) }}" method="POST"
                              onsubmit="return confirm('Вы уверены, что хотите удалить это удобство?');"
                              class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded shadow transition-colors duration-150">
                                Удалить
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
