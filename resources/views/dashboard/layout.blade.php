<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Fujitime">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Gallery</title>
    @vite(['resources/css/app.css', 'resources/flowbite/flowbite.min.css', 'resources/flowbite/flowbite.min.js'])
</head>
<body>

    @include('dashboard.partials.navbar')
        @include('dashboard.partials.sidebar')

    <main class="container mx-auto">
        @yield('content')
    </main>
    @stack('script')
</body>
</html>
