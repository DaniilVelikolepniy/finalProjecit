<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        {{-- Заголовок --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Отели</h1>
            <p class="mt-2 text-gray-500">Найдите идеальный отель для вашего путешествия</p>
        </div>

        {{-- Фильтры --}}
        <form action="{{ url()->current() }}" method="GET"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">

            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="min_price" class="block text-sm font-medium text-gray-700 mb-1.5">Мин. цена за ночь</label>
                    <div class="relative">
                        <input
                            type="number"
                            name="min_price"
                            id="min_price"
                            min="0"
                            value="{{ request('min_price') }}"
                            class="block w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="0 ₽">
                    </div>
                </div>

                <div class="flex-1">
                    <label for="max_price" class="block text-sm font-medium text-gray-700 mb-1.5">Макс. цена за ночь</label>
                    <div class="relative">
                        <input
                            type="number"
                            name="max_price"
                            id="max_price"
                            min="0"
                            value="{{ request('max_price') }}"
                            class="block w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="10 000 ₽">
                    </div>
                </div>

                <div class="sm:flex-shrink-0">
                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 text-white text-sm font-medium rounded-xl shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Поиск
                    </button>
                </div>
            </div>

            {{-- Удобства --}}
            <div x-data="{ showAll: false }" class="mt-6">
                <span class="block text-sm font-medium text-gray-700 mb-2">Удобства</span>

                <div class="flex flex-wrap gap-2">
                    @foreach($facilities as $index => $facility)
                        @if($index < 3)
                        <label
                            for="facility_{{ $facility->id }}"
                            class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition has-[:checked]:bg-primary-50 has-[:checked]:border-primary-300">
                            <input
                                type="checkbox"
                                name="facilities[]"
                                value="{{ $facility->id }}"
                                id="facility_{{ $facility->id }}"
                                @checked(is_array(request('facilities')) && in_array($facility->id, request('facilities')))
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                            >
                            <span class="text-sm text-gray-700">{{ $facility->name }}</span>
                        </label>
                        @endif
                    @endforeach
                </div>

                @if(count($facilities) > 3)
                <div class="mt-3">
                    <button
                        type="button"
                        @click="showAll = !showAll"
                        class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-800 focus:outline-none transition">
                        <span x-show="!showAll">Показать все удобства</span>
                        <span x-show="showAll">Скрыть</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300" :class="showAll ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        class="flex flex-wrap gap-2 overflow-hidden transition-all duration-300"
                        x-bind:class="showAll ? 'max-h-96 opacity-100 mt-2' : 'max-h-0 opacity-0'">
                        @foreach($facilities as $index => $facility)
                            @if($index >= 3)
                            <label
                                for="facility_{{ $facility->id }}"
                                class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2 cursor-pointer hover:bg-primary-50 hover:border-primary-200 transition has-[:checked]:bg-primary-50 has-[:checked]:border-primary-300">
                                <input
                                    type="checkbox"
                                    name="facilities[]"
                                    value="{{ $facility->id }}"
                                    id="facility_{{ $facility->id }}"
                                    @checked(is_array(request('facilities')) && in_array($facility->id, request('facilities')))
                                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                >
                                <span class="text-sm text-gray-700">{{ $facility->name }}</span>
                            </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </form>

        {{-- Список отелей --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Отелей не найдено</h3>
                        <p class="text-gray-500">Попробуйте изменить параметры поиска</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Пагинация --}}
        <div class="mt-8">
            {{ $hotels->links('pagination::tailwind') }}
        </div>
    </div>
</x-layouts.app>
