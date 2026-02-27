<x-layouts.app>
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <a href="{{ route('f.list') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Назад к удобствам
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Новое удобство</h2>
            <p class="text-gray-500 mb-8">Добавьте новое удобство для отелей и номеров.</p>

            <x-form-validation-errors />

            <form action="{{ route('f.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Название удобства <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" required autofocus
                        value="{{ old('name') }}"
                        class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-300 @enderror"
                        placeholder="Например: Wi-Fi, Парковка, Бассейн">
                </div>

                <div class="flex justify-between pt-4 border-t border-gray-100">
                    <a href="{{ route('f.list') }}"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                        Отмена
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-6 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-xl shadow-sm hover:bg-primary-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Создать
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
