<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden']) }}>
    <div class="p-5 sm:p-6">
        {{-- Заголовок --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-4 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Бронирование #{{ $booking->id }}</h3>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ $booking->created_at->format('d.m.Y в H:i') }}
                </p>
            </div>

            <div class="flex gap-2">
                @if($showLink ?? false)
                    <a href="{{ route('b.show', ['booking' => $booking]) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-xl hover:bg-primary-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Подробнее
                    </a>
                @endif

                <form method="POST" action="{{ route('b.destroy', $booking) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Вы уверены, что хотите отменить бронирование?')"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-700 bg-red-50 rounded-xl hover:bg-red-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Отменить
                    </button>
                </form>
            </div>
        </div>

        {{-- Контент --}}
        <div class="mt-4 flex flex-col md:flex-row gap-5">
            <div class="md:w-2/5">
                <img class="w-full h-48 object-cover rounded-xl"
                     src="{{ asset('/storage/'.$booking->room->poster_url) }}"
                     alt="{{ $booking->room->name }}"
                     loading="lazy">
            </div>

            <div class="md:w-3/5 flex flex-col justify-between">
                <div>
                    <h4 class="text-xl font-bold text-gray-900">{{ $booking->room->name }}</h4>

                    <div class="mt-3 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>
                                {{ \Carbon\Carbon::parse($booking->started_at)->format('d.m.Y') }}
                                —
                                {{ \Carbon\Carbon::parse($booking->finished_at)->format('d.m.Y') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <span>{{ $booking->days }} {{ $booking->days == 1 ? 'ночь' : ($booking->days < 5 ? 'ночи' : 'ночей') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                    <div class="text-right">
                        <span class="text-2xl font-bold text-gray-900">{{ number_format($booking->price, 0, ',', ' ') }} ₽</span>
                        <span class="block text-xs text-gray-500 mt-0.5">Итого</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
