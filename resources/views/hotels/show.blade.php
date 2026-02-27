@php
use Carbon\Carbon;

$startDate = Carbon::parse(request()->get('start_date', Carbon::now()->format('Y-m-d')));
$endDate = Carbon::parse(request()->get('end_date', Carbon::now()->addDay()->format('Y-m-d')));

$count = $startDate->diffInDays($endDate);

$startDateFormatted = $startDate->format('Y-m-d');
$endDateFormatted = $endDate->format('Y-m-d');
@endphp

<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        {{-- Навигация --}}
        <a href="{{ route('h.list') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Назад к списку отелей
        </a>

        {{-- Карточка отеля --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-2/5 relative">
                    <img class="w-full h-64 md:h-full object-cover"
                         src="{{ asset('storage/' . $hotel->poster_url) }}"
                         alt="Фото отеля '{{ $hotel->name }}'"
                         loading="lazy">
                </div>
                <div class="md:w-3/5 p-6 sm:p-8 flex flex-col justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $hotel->name }}</h1>

                        <div class="flex items-center gap-1.5 mt-3 text-gray-500">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $hotel->address }}</span>
                        </div>

                        <p class="mt-4 text-gray-600 leading-relaxed">{{ $hotel->description }}</p>

                        @if($hotel->facilities->isNotEmpty())
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($hotel->facilities as $facility)
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-lg">
                                        {{ $facility->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if(auth()->check() && (
                        auth()->user()->isAdmin() ||
                        (auth()->user()->isEditor() && $hotel->editor_id === auth()->id())
                    ))
                    <div class="flex flex-wrap gap-3 mt-6 pt-6 border-t border-gray-100">
                        <a href="{{ route('h.edit', ['hotel' => $hotel->id]) }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-xl hover:bg-primary-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Редактировать
                        </a>

                        <a href="{{ route('r.create', ['hotel' => $hotel->id]) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Добавить комнату
                        </a>

                        <form method="POST" action="{{ route('h.destroy', $hotel->id) }}"
                            onsubmit="return confirm('Вы уверены, что хотите удалить этот отель?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Удалить
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Секция бронирования --}}
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Забронировать комнату</h2>

            <form method="get" action="{{ url()->current() }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">Дата заезда</label>
                        <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDateFormatted }}"
                            type="date"
                            class="block w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>
                    <div class="flex-1">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1.5">Дата выезда</label>
                        <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDateFormatted }}"
                            class="block w-full border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>
                    <div class="sm:flex-shrink-0">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 text-white text-sm font-medium rounded-xl shadow-sm hover:bg-primary-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Загрузить номера
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Список номеров --}}
        @if($startDate && $endDate)
            <div class="space-y-4">
                @forelse($rooms as $room)
                    @php
                        $room->total_price = $room->price * $count;
                        $room->total_days = $count;
                        $room->startDate = $startDateFormatted;
                        $room->endDate = $endDateFormatted;
                    @endphp
                    <x-rooms.room-list-item :room="$room" />
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <p class="text-gray-500">Нет доступных номеров на выбранные даты</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</x-layouts.app>
