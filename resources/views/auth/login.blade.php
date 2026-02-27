<x-layouts.guest>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="w-16 h-16 fill-current text-primary-600" />
            </a>
        </x-slot>

        <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Вход в аккаунт</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('auth') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-label for="email" value="Электронная почта" />
                <x-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="example@mail.ru" />
            </div>

            <!-- Пароль -->
            <div class="mt-4">
                <x-label for="password" value="Пароль" />
                <x-input id="password" class="block mt-1.5 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                    placeholder="Введите пароль" />
            </div>

            <!-- Запомнить меня -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-primary-600 hover:text-primary-800 font-medium transition" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
                @endif
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                    Войти
                </button>
            </div>

            <div class="mt-6 text-center">
                <span class="text-sm text-gray-500">Нет аккаунта?</span>
                <a class="text-sm text-primary-600 hover:text-primary-800 font-medium ml-1 transition" href="{{ route('register') }}">
                    Зарегистрироваться
                </a>
            </div>
        </form>
    </x-auth-card>
</x-layouts.guest>
