<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Мои бронирования</h1>
            <p class="mt-2 text-gray-500">Управляйте своими бронированиями</p>
        </div>

        <div class="space-y-4">
            @if($bookings->isNotEmpty())
                @foreach($bookings as $booking)
                    <x-bookings.booking-card :booking="$booking" :show-link="true"/>
                @endforeach
            @else
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Нет бронирований</h3>
                    <p class="text-gray-500 mb-6">У вас пока нет активных бронирований</p>
                    <a href="{{ route('h.list') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-white bg-primary-600 rounded-xl hover:bg-primary-700 shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Найти отель
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
