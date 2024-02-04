@extends('layouts.app-master')

@section('content')
<div class="container mx-auto my-8">
    <h2 class="text-2xl font-bold mb-4">Categories</h2>

    <!-- Tambahkan tautan ke halaman create -->
    <a href="{{ route('categories.create') }}" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200 mb-4 inline-block">Add New Category</a>

    <!-- Tabel Categories -->
    <table class="min-w-full border rounded-md overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                    <td class="py-2 px-4 border-b">

                        <!-- Tautan ke halaman edit -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>

                        <!-- Form untuk delete -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="py-2 px-4 border-b" colspan="3">No categories available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
