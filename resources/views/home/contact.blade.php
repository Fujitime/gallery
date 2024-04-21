@extends('layouts.app-master')

@section('content')
    <div class="container mx-auto py-6">
        <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2">Contact</h2>
                <p class="text-gray-600 dark:text-gray-400">Silakan menghubungi jika Anda memiliki pertanyaan atau masukan.</p>
                <form action="#" method="POST" class="mt-8">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
