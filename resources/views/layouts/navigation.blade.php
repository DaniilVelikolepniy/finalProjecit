<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-40 backdrop-blur-lg bg-white/95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <x-application-logo class="block h-8 w-auto fill-current text-primary-600 group-hover:text-primary-700 transition" />
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:flex sm:items-center sm:ml-8 sm:space-x-1">
                    <x-nav-link href="{{ route('h.list') }}" active="{{ request()->routeIs('h.list') }}">
                        {{ __('Список отелей') }}
                    </x-nav-link>

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('h.create') }}" active="{{ request()->routeIs('h.create') }}">
                            {{ __('Добавление отеля') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('roles.index') }}" active="{{ request()->routeIs('roles.index') }}">
                            {{ __('Ролевая модель') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('usersListForAdmin') }}" active="{{ request()->routeIs('usersListForAdmin') }}">
                            {{ __('Все пользователи') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && auth()->user()->isEditor())
                        <x-nav-link href="{{ route('e.usersList') }}" active="{{ request()->routeIs('e.usersList') }}">
                            {{ __('Постояльцы отеля') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('f.list') }}" active="{{ request()->routeIs('f.list') }}">
                            {{ __('Удобства') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="flex items-center">
                <!-- User Dropdown (Desktop) -->
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-200">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-primary-700">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <x-dropdown-link :href="route('profile.show')">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ __('Профиль') }}
                                    </span>
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('b.index')">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Брони') }}
                                    </span>
                                </x-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span class="flex items-center gap-2 text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            {{ __('Выйти') }}
                                        </span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex sm:items-center sm:ml-6 sm:space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                            {{ __('Войти') }}
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 px-4 py-2 rounded-lg transition shadow-sm">
                            {{ __('Регистрация') }}
                        </a>
                    </div>
                @endauth

                <!-- Hamburger (Mobile) -->
                <div class="flex items-center sm:hidden ml-2">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link href="{{ route('h.list') }}" active="{{ request()->routeIs('h.list') }}">
                {{ __('Список отелей') }}
            </x-responsive-nav-link>

            @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link href="{{ route('h.create') }}" active="{{ request()->routeIs('h.create') }}">
                    {{ __('Добавление отеля') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link href="{{ route('roles.index') }}" active="{{ request()->routeIs('roles.index') }}">
                    {{ __('Ролевая модель') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link href="{{ route('usersListForAdmin') }}" active="{{ request()->routeIs('usersListForAdmin') }}">
                    {{ __('Все пользователи') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->check() && auth()->user()->isEditor())
                <x-responsive-nav-link href="{{ route('e.usersList') }}" active="{{ request()->routeIs('e.usersList') }}">
                    {{ __('Постояльцы отеля') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link href="{{ route('f.list') }}" active="{{ request()->routeIs('f.list') }}">
                    {{ __('Удобства') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile User Section -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200 px-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                        <span class="text-sm font-semibold text-primary-700">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('profile.show')">
                        {{ __('Профиль') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('b.index')">
                        {{ __('Брони') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Выйти') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    {{ __('Войти') }}
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition">
                    {{ __('Регистрация') }}
                </a>
            </div>
        @endauth
    </div>
</nav>
