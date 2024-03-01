<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Fujitime">
    <meta name="generator" content="Hugo 0.87.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gallery</title>
    @vite(['resources/js/app.js', 'resources/js/sweetalert.js', 'resources/css/app.css', 'resources/flowbite/flowbite.min.css', 'resources/flowbite/flowbite.min.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">

    @include('dashboard.partials.navbar')

    <main class="container bg-gray-100 dark:bg-gray-800 mx-auto">
        @yield('content')
    </main>
    @include('layouts.partials.footer')
    @stack('script')
</body>

</html>
