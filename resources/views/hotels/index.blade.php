<x-layouts.app>
    <div class="py-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ url()->current() }}" method="GET"
            class="bg-white rounded-lg shadow-[0_0_15px_gray] mt-[15px] mb-[30px] p-6">

            <!-- Строка: минимальная цена, максимальная цена, кнопка поиска -->
            <div class="flex flex-wrap gap-4 items-end">
                <div class="flex-grow-[2] basis-0">
                    <label for="min_price" class="block text-sm font-medium text-gray-700">Минимальная цена за ночь</label>
                    <input
                        type="number"
                        name="min_price"
                        id="min_price"
                        min="0"
                        value="{{ request('min_price') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-3 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="0 ₽">
                </div>

                <div class="flex-grow-[2] basis-0">
                    <label for="max_price" class="block text-sm font-medium text-gray-700">Максимальная цена за ночь</label>
                    <input
                        type="number"
                        name="max_price"
                        id="max_price"
                        min="0"
                        value="{{ request('max_price') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-3 px-3 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="10 000 ₽">
                </div>

                <div class="flex-grow basis-0">
                    <button
                        type="submit"
                        class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        Поиск
                    </button>
                </div>
            </div>

            <!-- Блок удобств -->
            <div x-data="{ showAll: false }" class="mt-6">
                <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>

                <!-- Первые три чекбокса -->
                <div class="flex flex-wrap gap-3">
                    @foreach($facilities as $index => $facility)
                        @if($index < 3)
                        <label
                            for="facility_{{ $facility->id }}"
                            class="flex items-center space-x-2 border rounded-lg p-2 cursor-pointer hover:bg-blue-50 transition flex-grow basis-[calc(33.333%-0.75rem)]">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                id="facility_{{ $facility->id }}"
                                @checked(is_array(request('facilities')) && in_array($facility->id, request('facilities')))
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <span class="text-gray-700 text-sm">{{ $facility->name }}</span>
                        </label>
                        @endif
                    @endforeach
                </div>

                <!-- Кнопка показать/скрыть и оставшиеся чекбоксы -->
                @if(count($facilities) > 3)
                <div class="flex items-center justify-center my-4">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <button
                        type="button"
                        @click="showAll = !showAll"
                        class="mx-4 flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 focus:outline-none">
                        <span x-show="!showAll" class="flex items-center space-x-1">
                            <span>Показать все</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                        <span x-show="showAll" class="flex items-center space-x-1">
                            <span>Скрыть</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <div
                    class="flex flex-wrap gap-3 overflow-hidden transition-all duration-500"
                    x-bind:class="showAll ? 'max-h-screen opacity-100 mt-3' : 'max-h-0 opacity-0'">
                    @foreach($facilities as $index => $facility)
                        @if($index >= 3)
                        <label
                            for="facility_{{ $facility->id }}"
                            class="flex items-center space-x-2 border rounded-lg p-2 cursor-pointer hover:bg-blue-50 transition flex-grow basis-[calc(33.333%-0.75rem)]">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                id="facility_{{ $facility->id }}"
                                @checked(is_array(request('facilities')) && in_array($facility->id, request('facilities')))
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <span class="text-gray-700 text-sm">{{ $facility->name }}</span>
                        </label>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
        </form>

        <!-- Список отелей -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @empty
                <div class="col-span-full text-center text-gray-500 py-10">
                    Отелей не найдено
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        <div class="mt-6">
            {{ $hotels->links('pagination::tailwind') }}
        </div>
    </div>
</x-layouts.app>
