<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|poppins:700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-white">
<div class="min-h-screen relative">
    <!-- Subtle Background Pattern -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(236,72,153,0.05)_0%,transparent_70%)] dark:bg-[radial-gradient(circle_at_center,rgba(168,85,247,0.05)_0%,transparent_70%)] opacity-30 pointer-events-none"></div>

    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-gradient-to-r from-pink-500/10 to-purple-500/10 dark:from-pink-500/5 dark:to-purple-500/5 shadow-[0_4px_20px_rgba(0,0,0,0.1)] dark:shadow-[0_4px_20px_rgba(255,255,255,0.03)] relative z-10">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fade-in">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="relative z-10">
        {{ $slot }}
    </main>
</div>
</body>
</html>
