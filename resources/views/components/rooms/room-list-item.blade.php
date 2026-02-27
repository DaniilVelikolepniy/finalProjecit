<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300']) }}>
    <div class="flex flex-col md:flex-row">
        <div class="md:w-2/5 relative overflow-hidden">
            @php
                $image = asset('storage/' . $room->poster_url);
            @endphp
            <div class="h-56 md:h-full w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $image }}'); min-height: 200px;">
            </div>

            @if(auth()->check() && (
                auth()->user()->isAdmin() ||
                (auth()->user()->isEditor() && $room->hotel->editor_id === auth()->id())
            ))
                <div class="absolute top-3 right-3 flex flex-col gap-2">
                    <a href="{{ route('r.edit', $room->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-white bg-primary-600/90 backdrop-blur-sm rounded-lg hover:bg-primary-700 shadow-sm transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Редактировать
                    </a>
                    <form action="{{ route('r.destroy', $room->id) }}" method="POST"
                          onsubmit="return confirm('Вы уверены, что хотите удалить эту комнату?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-white bg-red-600/90 backdrop-blur-sm rounded-lg hover:bg-red-700 shadow-sm transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Удалить
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="md:w-3/5 p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $room->name }}</h3>

                @php
                    $roomTypeLabels = [
                        'economy' => 'Эконом',
                        'standard' => 'Стандарт',
                        'comfort' => 'Комфорт',
                        'business' => 'Бизнес',
                        'luxury' => 'Люкс',
                        'presidential' => 'Президентский',
                    ];
                @endphp
                <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-gray-500">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                        {{ $room->floor_area }} м²
                    </span>
                    @if($room->type)
                        <span class="text-gray-300">•</span>
                        <span>{{ $roomTypeLabels[$room->type] ?? ucfirst($room->type) }}</span>
                    @endif
                </div>

                @if($room->facilities->isNotEmpty())
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        @foreach($room->facilities as $facility)
                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">
                                {{ $facility->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-5 pt-5 border-t border-gray-100">
                <div>
                    <span class="text-2xl font-bold text-gray-900">{{ number_format($room->total_price, 0, ',', ' ') }} ₽</span>
                    <span class="text-sm text-gray-500 block sm:inline sm:ml-1">за {{ $room->total_days }} {{ $room->total_days == 1 ? 'ночь' : ($room->total_days < 5 ? 'ночи' : 'ночей') }}</span>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <a href="{{ route('r.show', $room->id) }}"
                       class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                        Подробнее
                    </a>

                    <form method="POST" action="{{ route('b.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="started_at" value="{{ $room->startDate }}">
                        <input type="hidden" name="finished_at" value="{{ $room->endDate }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="price" value="{{ $room->total_price }}">
                        <input type="hidden" name="days" value="{{ $room->total_days }}">
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-xl hover:bg-primary-700 shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Забронировать
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
