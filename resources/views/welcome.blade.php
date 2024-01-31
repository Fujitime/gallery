<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Link your CSS file containing Tailwind CSS styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
    <body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-white">
    <!-- Navigation -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto">
            <a href="#" class="text-white font-bold">Gallery</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-bold mb-4">Welcome to Our Gallery</h1>
        <p class="text-lg mb-8">Explore our amazing collection of images.</p>

        <!-- Gallery Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Example Image Cards (Replace with your gallery images) -->
            <div class="bg-gray-200 dark:bg-gray-800 rounded-lg p-4">
                <img src="https://via.placeholder.com/500" alt="Gallery Image" class="w-full h-auto rounded-lg">
            </div>
            <div class="bg-gray-200 dark:bg-gray-800 rounded-lg p-4">
                <img src="https://via.placeholder.com/500" alt="Gallery Image" class="w-full h-auto rounded-lg">
            </div>
            <div class="bg-gray-200 dark:bg-gray-800 rounded-lg p-4">
                <img src="https://via.placeholder.com/500" alt="Gallery Image" class="w-full h-auto rounded-lg">
            </div>
            <!-- Add more image cards as needed -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 dark:bg-gray-800 text-center py-4 mt-8">
        <p class="text-gray-600 dark:text-gray-400">&copy; 2024 Gallery. All rights reserved.</p>
    </footer>
</body>

</html>
