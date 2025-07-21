<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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