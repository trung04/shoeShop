<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BamboShop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="http://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- Global Container --}}
    <div class="min-h-screen bg-blue-200 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        {{-- Inner Container --}}
        <div class="bg-white shadow-xl shadow-blue-500  sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
