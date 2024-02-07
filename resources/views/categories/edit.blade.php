@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Category</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-600">Category Name:</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required
                    class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
