<x-layouts.guest>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="w-16 h-16 fill-current text-primary-600" />
            </a>
        </x-slot>

        <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Создать аккаунт</h2>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Имя -->
            <div>
                <x-label for="name" value="Имя" />
                <x-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Введите ваше имя" />
            </div>

            <!-- Электронная почта -->
            <div class="mt-4">
                <x-label for="email" value="Электронная почта" />
                <x-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required placeholder="example@mail.ru" />
            </div>

            <!-- Пароль -->
            <div class="mt-4">
                <x-label for="password" value="Пароль" />
                <x-input id="password" class="block mt-1.5 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password"
                    placeholder="Минимум 8 символов" />
            </div>

            <!-- Подтверждение пароля -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="Подтверждение пароля" />
                <x-input id="password_confirmation" class="block mt-1.5 w-full"
                    type="password"
                    name="password_confirmation" required
                    placeholder="Повторите пароль" />
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                    Зарегистрироваться
                </button>
            </div>

            <div class="mt-6 text-center">
                <span class="text-sm text-gray-500">Уже есть аккаунт?</span>
                <a class="text-sm text-primary-600 hover:text-primary-800 font-medium ml-1 transition" href="{{ route('login') }}">
                    Войти
                </a>
            </div>
        </form>
    </x-auth-card>
</x-layouts.guest>
