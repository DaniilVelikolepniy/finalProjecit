<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 group">
    <div class="flex flex-col sm:flex-row">
        <div class="sm:w-2/5 relative overflow-hidden h-48 sm:h-auto">
            <img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500"
                 src="{{ asset('storage/' . $hotel->poster_url) }}"
                 alt="Фото отеля '{{ $hotel->name }}'"
                 loading="lazy">
            @if($hotel->rooms()->min('price'))
                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                    <span class="text-lg font-bold text-gray-900">₽{{ number_format($hotel->rooms()->min('price'), 0, ',', ' ') }}</span>
                    <span class="text-xs text-gray-500"> / ночь</span>
                </div>
            @endif
        </div>
        <div class="sm:w-3/5 p-5 flex flex-col justify-between">
            <div>
                <a class="text-lg font-bold text-gray-900 hover:text-primary-600 transition duration-200"
                   href="{{ route('h.show', ['hotel' => $hotel]) }}">
                    {{ $hotel->name }}
                </a>
                <div class="flex items-center gap-1.5 mt-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $hotel->address }}
                </div>
            </div>

            @if($hotel->facilities->isNotEmpty())
                <div class="flex flex-wrap gap-1.5 mt-3">
                    @foreach($hotel->facilities->take(3) as $facility)
                        <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">
                            {{ $facility->name }}
                        </span>
                    @endforeach
                    @if($hotel->facilities->count() > 3)
                        <span class="inline-flex items-center px-2.5 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-lg">
                            +{{ $hotel->facilities->count() - 3 }}
                        </span>
                    @endif
                </div>
            @endif

            <div class="flex justify-end mt-4">
                <a href="{{ route('h.show', ['hotel' => $hotel]) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-xl hover:bg-primary-700 shadow-sm transition duration-200">
                    Подробнее
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
