<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

    <style>
        .main {
            margin: 0;
            padding: 0 25px;
            height: 90vh;
            width: calc(100vw - 50px);
            display: grid;
            justify-content: center;
            align-items: center;
        }

        .form {
            background-color: #f8f8f8;
            height: 65vh;
            width: 35vw;
            border-radius: 10px;
            box-shadow: 0px 0px 40px 10px rgba(0, 0, 0, 0.5);
            display: grid;
            align-items: center;
            justify-items: center;
            justify-content: center;
            align-content: stretch;
        }

        .form label {
            display: block;
            font-size: 20px;
        }

        .form .input {
            margin-top: 10px;
            padding: 7px;
            width: 30vw;
            height: fit-content;
            border-radius: 7px;
            border: solid 1px black;
            font-size: 18px;
        }

        .form #description {
            resize: none;
            height: 10vh;
        }

        .form .buttons {
            width: 31vw;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }

        .form .button {
            display: flex;
            cursor: pointer;
            margin: 0;
            width: 12.5vw;
            height: 3vh;
            border-radius: 3px;
            border: solid 1px black;
            background-color: darkgray;
            color: black;
            font-size: 18px;
            text-decoration: none;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="font-sans antialiased">

    @if ($errors->has('booking'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="fixed left-1/2 transform -translate-x-1/2 z-50"
        style="top:2vh;">
        <div class="relative flex items-center w-[13vw] min-w-[286px] max-w-[90vw] h-fit px-4 py-2 bg-yellow-100 rounded-[20px] shadow-[0_0_15px_0_rgba(0,0,0,0.15)] border border-yellow-300" style="height: fit-content;">
            <button @click="show = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex items-center">
                <svg class="w-7 h-7 mr-3 flex-shrink-0" viewBox="0 0 32 32" fill="none">
                    <rect x="2" y="4" width="28" height="24" rx="8" fill="#FACC15" stroke="#F59E42" stroke-width="2" />
                    <polygon points="16,8 26,24 6,24" fill="#FDE68A" />
                    <text x="16" y="22" text-anchor="middle" font-size="16" font-weight="bold" fill="black" dy="0.1em">!</text>
                </svg>
                <span class="text-black text-sm font-medium">
                    {{ $errors->first('booking') }}
                </span>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-gray-100 min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if(isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="px-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>