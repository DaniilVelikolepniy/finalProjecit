<x-layouts.app>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <!-- Кнопка назад -->
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-700 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Назад
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Изображение комнаты -->
                <div class="md:w-2/5 relative">
                    @if($room->poster_url)
                        <img src="{{ asset('storage/' . $room->poster_url) }}"
                             alt="{{ $room->name }}"
                             class="w-full h-64 md:h-full object-cover"
                             loading="lazy">
                    @else
                        <div class="flex items-center justify-center h-64 md:h-full bg-gray-100 text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Информация о комнате -->
                <div class="md:w-3/5 p-6 sm:p-8 flex flex-col justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">{{ $room->name }}</h1>

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
                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-4">
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

                        <p class="text-gray-600 leading-relaxed mb-5">{{ $room->description }}</p>

                        <!-- Удобства -->
                        @if($room->facilities->isNotEmpty())
                            <div class="mb-5">
                                <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-3">Удобства</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($room->facilities as $facility)
                                        <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded-lg">
                                            {{ $facility->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Информация об отеле -->
                    <div class="mt-6 pt-6 border-t border-gray-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span>Отель: <span class="font-medium text-gray-900">{{ $room->hotel->name }}</span></span>
                        </div>
                        <a href="{{ url()->previous() }}"
                           class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Назад
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
