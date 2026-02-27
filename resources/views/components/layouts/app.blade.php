<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Система бронирования отелей — найдите и забронируйте лучшие номера">

    <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <script>
        // Тёмная тема: инициализация до рендеринга
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

    <style>
        /* Плавные переходы для всех интерактивных элементов */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Плавный переход темы */
        html.transitioning,
        html.transitioning *,
        html.transitioning *::before,
        html.transitioning *::after {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
        }

        /* Скроллбар */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* Тёмная тема: скроллбар */
        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* ===== ТЁМНАЯ ТЕМА ===== */

        /* Фоны */
        .dark .bg-white { background-color: #1e293b !important; }
        .dark .bg-gray-50 { background-color: #0f172a !important; }
        .dark .bg-gray-100 { background-color: #334155 !important; }
        .dark .bg-gray-200 { background-color: #475569 !important; }

        /* Тексты — светлые и читаемые */
        .dark .text-gray-900 { color: #f8fafc !important; }
        .dark .text-gray-800 { color: #f1f5f9 !important; }
        .dark .text-gray-700 { color: #e2e8f0 !important; }
        .dark .text-gray-600 { color: #cbd5e1 !important; }
        .dark .text-gray-500 { color: #94a3b8 !important; }
        .dark .text-gray-400 { color: #94a3b8 !important; }
        .dark .text-grey-darkest { color: #f1f5f9 !important; }

        /* Границы — видимые */
        .dark .border-gray-200 { border-color: #475569 !important; }
        .dark .border-gray-100 { border-color: #334155 !important; }
        .dark .border-gray-300 { border-color: #64748b !important; }
        .dark .border-b { border-color: #475569 !important; }

        /* Тени — заметные на тёмном фоне */
        .dark .shadow-sm { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(71, 85, 105, 0.3) !important; }
        .dark .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(71, 85, 105, 0.3) !important; }
        .dark .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(71, 85, 105, 0.3) !important; }

        /* Формы */
        .dark input, .dark textarea, .dark select {
            background-color: #1e293b !important;
            border-color: #475569 !important;
            color: #f1f5f9 !important;
        }
        .dark input::placeholder, .dark textarea::placeholder {
            color: #64748b !important;
        }
        .dark input:focus, .dark textarea:focus, .dark select:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3) !important;
        }
        .dark input[type="checkbox"] {
            background-color: #334155 !important;
            border-color: #64748b !important;
        }

        /* Hover-состояния */
        .dark .hover\:bg-gray-100:hover { background-color: #334155 !important; }
        .dark .hover\:bg-gray-50:hover { background-color: #1e293b !important; }
        .dark .hover\:bg-gray-200:hover { background-color: #475569 !important; }
        .dark .hover\:shadow-md:hover { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(71, 85, 105, 0.4) !important; }

        /* Цветные фоны — более насыщенные для видимости */
        .dark .bg-primary-50 { background-color: rgba(59, 130, 246, 0.15) !important; }
        .dark .bg-primary-100 { background-color: rgba(59, 130, 246, 0.2) !important; }
        .dark .bg-red-50 { background-color: rgba(239, 68, 68, 0.15) !important; }
        .dark .bg-red-100 { background-color: rgba(239, 68, 68, 0.2) !important; }
        .dark .bg-emerald-50 { background-color: rgba(16, 185, 129, 0.15) !important; }
        .dark .bg-emerald-100 { background-color: rgba(16, 185, 129, 0.2) !important; }
        .dark .bg-amber-50 { background-color: rgba(245, 158, 11, 0.15) !important; }
        .dark .bg-amber-100 { background-color: rgba(245, 158, 11, 0.2) !important; }
        .dark .bg-blue-100 { background-color: rgba(59, 130, 246, 0.2) !important; }
        .dark .bg-purple-100 { background-color: rgba(139, 92, 246, 0.2) !important; }
        .dark .bg-yellow-100 { background-color: rgba(245, 158, 11, 0.15) !important; }

        /* Цветные тексты — ярче для тёмного фона */
        .dark .text-primary-700 { color: #93c5fd !important; }
        .dark .text-primary-600 { color: #60a5fa !important; }
        .dark .text-red-700 { color: #fca5a5 !important; }
        .dark .text-red-600 { color: #f87171 !important; }
        .dark .text-emerald-700 { color: #6ee7b7 !important; }
        .dark .text-emerald-600 { color: #34d399 !important; }
        .dark .text-amber-700 { color: #fcd34d !important; }
        .dark .text-amber-600 { color: #fbbf24 !important; }

        /* Hover для цветных фонов */
        .dark .hover\:bg-primary-100:hover { background-color: rgba(59, 130, 246, 0.25) !important; }
        .dark .hover\:bg-red-100:hover { background-color: rgba(239, 68, 68, 0.25) !important; }
        .dark .hover\:bg-emerald-100:hover { background-color: rgba(16, 185, 129, 0.25) !important; }

        /* Навигация */
        .dark .hover\:text-gray-900:hover { color: #f8fafc !important; }
        .dark .hover\:text-gray-700:hover { color: #e2e8f0 !important; }

        /* Dropdown */
        .dark .ring-1 { --tw-ring-color: rgba(71, 85, 105, 0.5) !important; }
        .dark .ring-black { --tw-ring-color: rgba(71, 85, 105, 0.5) !important; }
        .dark .py-1.bg-white { background-color: #1e293b !important; }

        /* Бейджи/теги удобств */
        .dark .bg-gray-100.text-gray-600,
        .dark .bg-gray-100.text-gray-700,
        .dark .bg-gray-100.text-gray-800 {
            background-color: #334155 !important;
            color: #e2e8f0 !important;
            border: 1px solid #475569 !important;
        }

        /* Бейдж цены на карточке отеля */
        .dark .bg-white\/90 {
            background-color: rgba(30, 41, 59, 0.95) !important;
            border: 1px solid #475569;
        }

        /* Файловый инпут */
        .dark .file\:bg-blue-50,
        .dark .file\:bg-primary-50 {
            background-color: rgba(59, 130, 246, 0.2) !important;
        }

        /* Footer */
        .dark .hover\:text-gray-700:hover { color: #f1f5f9 !important; }

        /* Градиент на странице авторизации */
        .dark .from-gray-50 { --tw-gradient-from: #0f172a !important; }
        .dark .to-gray-100 { --tw-gradient-to: #1e293b !important; }

        /* Выпадающие меню */
        .dark [x-show].absolute {
            background-color: #1e293b !important;
            border-color: #475569 !important;
        }
        .dark [x-show].absolute button:hover,
        .dark [x-show].absolute a:hover {
            background-color: #334155 !important;
        }
        .dark .rounded-xl.overflow-hidden .py-1,
        .dark .rounded-md .py-1 {
            background-color: #1e293b !important;
        }
        .dark .hover\:bg-gray-50:hover { background-color: #334155 !important; }
        .dark .hover\:bg-indigo-100:hover { background-color: rgba(99, 102, 241, 0.2) !important; }
        .dark .hover\:bg-violet-100:hover { background-color: rgba(139, 92, 246, 0.2) !important; }
        .dark .hover\:bg-rose-100:hover { background-color: rgba(244, 63, 94, 0.2) !important; }
        .dark .hover\:text-rose-600:hover { color: #fb7185 !important; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
    {{-- Уведомление об ошибке бронирования --}}
    @if ($errors->has('booking'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4">
        <div class="flex items-center gap-3 px-4 py-3 bg-amber-50 border border-amber-200 rounded-xl shadow-lg">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-amber-800 flex-1">{{ $errors->first('booking') }}</span>
            <button @click="show = false" class="flex-shrink-0 text-amber-400 hover:text-amber-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    {{-- Уведомление об успехе --}}
    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4">
        <div class="flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl shadow-lg">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-emerald-800 flex-1">{{ session('success') }}</span>
            <button @click="show = false" class="flex-shrink-0 text-emerald-400 hover:text-emerald-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    {{-- Навигация --}}
    @include('layouts.navigation')

    {{-- Заголовок страницы --}}
    @if(isset($header))
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif

    {{-- Основной контент --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Все права защищены.
                </p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('h.list') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">Отели</a>
                    @auth
                        <a href="{{ route('b.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">Брони</a>
                        <a href="{{ route('profile.show') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">Профиль</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
