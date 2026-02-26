<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Профиль') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Обложка --}}
                <div class="h-32 sm:h-40 bg-gradient-to-r from-primary-500 via-primary-600 to-primary-700"></div>

                {{-- Информация о пользователе --}}
                <div class="px-6 sm:px-8 pb-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-4 -mt-12 sm:-mt-14">
                        {{-- Аватар --}}
                        <div class="flex-shrink-0">
                            <img
                                class="h-24 w-24 sm:h-28 sm:w-28 rounded-2xl object-cover border-4 border-white shadow-lg"
                                src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=200&d=mp"
                                alt="Аватар пользователя"
                            />
                        </div>

                        <div class="flex-1 text-center sm:text-left pb-1">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-500 mt-0.5">Участник с {{ $user->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>

                    {{-- Детали --}}
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-sm font-medium text-gray-900">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Имя</p>
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Быстрые действия --}}
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('h.list') }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-primary-700 bg-primary-50 rounded-xl hover:bg-primary-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Смотреть отели
                        </a>
                        <a href="{{ route('b.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Мои бронирования
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
