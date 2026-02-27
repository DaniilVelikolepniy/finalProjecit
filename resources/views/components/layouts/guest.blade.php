<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
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
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
        <style>
            .dark .bg-white { background-color: #1e293b !important; }
            .dark .bg-gray-50 { background-color: #0f172a !important; }
            .dark .bg-gray-100 { background-color: #334155 !important; }
            .dark .text-gray-900 { color: #f8fafc !important; }
            .dark .text-gray-800 { color: #f1f5f9 !important; }
            .dark .text-gray-700 { color: #e2e8f0 !important; }
            .dark .text-gray-600 { color: #cbd5e1 !important; }
            .dark .text-gray-500 { color: #94a3b8 !important; }
            .dark .border-gray-200 { border-color: #475569 !important; }
            .dark .border-gray-100 { border-color: #334155 !important; }
            .dark .border-gray-300 { border-color: #64748b !important; }
            .dark .shadow-sm { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(71, 85, 105, 0.3) !important; }
            .dark .from-gray-50 { --tw-gradient-from: #0f172a !important; }
            .dark .to-gray-100 { --tw-gradient-to: #1e293b !important; }
            .dark input, .dark textarea, .dark select {
                background-color: #1e293b !important;
                border-color: #475569 !important;
                color: #f1f5f9 !important;
            }
            .dark input::placeholder { color: #64748b !important; }
            .dark input:focus, .dark textarea:focus {
                border-color: #60a5fa !important;
                box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3) !important;
            }
            .dark input[type="checkbox"] {
                background-color: #334155 !important;
                border-color: #64748b !important;
            }
            .dark .text-primary-600 { color: #60a5fa !important; }
            .dark .hover\:text-primary-800:hover { color: #93c5fd !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            {{ $slot }}
        </div>
    </body>
</html>
