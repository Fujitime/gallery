@extends('dashboard.layout')

@section('content')
<div class="container mx-auto">
    <div class="p-5 mt-32">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Edit Category</h2>

            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-400">Category
                        Name:</label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}" required
                        class="mt-1 p-2 border rounded-md w-full focus:outline-none dark:bg-gray-700 dark:text-white focus:border-green-500">
                </div>

                <div>
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 dark:hover:bg-green-700 transition duration-200">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
