<x-layouts.app>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight">
                    Найдите идеальный
                    <span class="block text-primary-200">отель для отдыха</span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg sm:text-xl text-primary-100">
                    Бронируйте номера в лучших отелях быстро и удобно. Широкий выбор, прозрачные цены, мгновенное подтверждение.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('h.list') }}"
                       class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-primary-700 bg-white rounded-xl hover:bg-primary-50 shadow-lg hover:shadow-xl transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Смотреть отели
                    </a>
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center px-8 py-3.5 text-base font-semibold text-white border-2 border-white/30 rounded-xl hover:bg-white/10 transition duration-200">
                            Зарегистрироваться
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Почему выбирают нас</h2>
            <p class="mt-3 text-lg text-gray-500">Простой и удобный сервис бронирования</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <div class="w-14 h-14 mx-auto mb-4 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Удобный поиск</h3>
                <p class="text-gray-500">Фильтрация по цене, удобствам и расположению для быстрого выбора</p>
            </div>

            <div class="text-center p-6 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <div class="w-14 h-14 mx-auto mb-4 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Мгновенное бронирование</h3>
                <p class="text-gray-500">Забронируйте номер в пару кликов с моментальным подтверждением</p>
            </div>

            <div class="text-center p-6 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                <div class="w-14 h-14 mx-auto mb-4 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Лучшие цены</h3>
                <p class="text-gray-500">Прозрачное ценообразование без скрытых комиссий и доплат</p>
            </div>
        </div>
    </div>
</x-layouts.app>
