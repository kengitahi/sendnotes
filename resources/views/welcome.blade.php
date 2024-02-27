<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative min-h-screen bg-gray-100 bg-center bg-dots-darker dark:bg-dots-lighter selection:bg-red-500 selection:text-white dark:bg-gray-900 sm:flex sm:items-center sm:justify-center">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

        <div class="flex flex-col items-center p-6 mx-auto space-y-4 max-w-7xl lg:p-8">
            <x-application-logo class="fill-current size-24 text-primary" />
            <x-button href="{{ route('register') }}" primary xl>Get Started</x-button>
        </div>
    </div>
</body>

</html>
