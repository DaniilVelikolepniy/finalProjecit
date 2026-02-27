<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Удобства</h1>
                <p class="mt-2 text-gray-500">Управление удобствами отелей и номеров</p>
            </div>

            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('f.create') }}"
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-xl shadow-sm hover:bg-primary-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Создать новое
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($facilites as $facility)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition duration-300 flex flex-col">
                    <div class="flex-1 flex items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $facility->name }}</h2>
                    </div>

                    <div class="flex gap-2 mt-auto">
                        <a href="{{ route('f.edit', $facility->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-xs font-medium text-primary-700 bg-primary-50 rounded-xl hover:bg-primary-100 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Изменить
                        </a>

                        <form action="{{ route('f.destroy', $facility->id) }}" method="POST"
                              onsubmit="return confirm('Вы уверены, что хотите удалить это удобство?');"
                              class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-1 px-3 py-2 text-xs font-medium text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition">
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
