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
    <!-- Load CSS asynchronously -->
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('resources/flowbite/flowbite.min.css') }}">
    <style>
        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a202c;
                color: #ffffff;
            }
        }
    </style>
    @vite(['resources/js/app.js', 'resources/js/sweetalert.js', 'resources/flowbite/flowbite.min.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">

    @include('dashboard.partials.navbar')

    <main class="container mx-auto bg-gray-100 dark:bg-gray-800">
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    @stack('script')

    <!-- Apply dark mode asynchronously to prevent flickering -->
    <script>
        (function() {
            // Set default theme to dark if not set
            if (!localStorage.getItem('theme')) {
                localStorage.setItem('theme', 'dark');
            }

            // Apply dark mode asynchronously to prevent flickering
            const applyDarkMode = () => {
                const currentTheme = localStorage.getItem('theme');
                if (currentTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            };

            applyDarkMode();
        })();
    </script>
</body>
</html>
