@extends('dashboard.layout')

@section('content')
<div class="container mx-auto my-8">
    <div class="p-5 mt-32">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Create Category</h2>

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Category Name:</label>
                    <input type="text" name="name" id="name" required class="mt-1 p-2 border rounded-md w-full focus:outline-none dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:border-blue-500">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:hover:bg-blue-700 transition duration-200">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
