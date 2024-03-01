<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="fujitime">
    <meta name="generator" content="Hugo 0.87.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gallery</title>
    @vite(['resources/js/app.js', 'resources/js/sweetalert.js', 'resources/css/app.css', 'resources/flowbite/flowbite.min.css', 'resources/flowbite/flowbite.min.js'])
<body>

    <main class="form-signin">
        @yield('content')
    </main>
    @stack('script')
</body>
</html>
