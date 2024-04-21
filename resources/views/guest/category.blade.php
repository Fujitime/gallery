@extends('layouts.app-master')

@section('content')
<div class="container pt-5 mx-auto ">
    @auth
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->username }}!</h1>
    @endif

    <!-- Tampilkan galeri jika ada -->
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galleries as $gallery)
                <div class="relative bg-white rounded overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded">

                    <!-- Display multiple categories if available -->
                    @if(count($gallery->categories) > 0)
                        <div class="absolute top-0 left-0 p-2">
                            @foreach($gallery->categories as $category)
                                <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Display multiple albums if available -->
                    @if(count($gallery->albums) > 0)
                        <div class="absolute top-0 right-0 p-2">
                            @foreach($gallery->albums as $album)
                                <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $album->title }}</span>
                                <span class="bg-green-900 text-white px-2 py-1 rounded">{{ $album->description }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-bold mb-2">{{ $gallery->title }}</h3>
                        <p class="text-gray-600">{{ $gallery->description }}</p>

                        <!-- Buttons for actions -->

                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('galleries.show', $gallery->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                        @if(auth()->user() && (auth()->user()->role === 'admin' || auth()->user()->id === $gallery->user_id))
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="text-green-500 hover:text-green-700">Edit</a>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        @elseif(auth()->user() && auth()->user()->id === $gallery->user_id)
                            <a href="{{ route('galleries.show', $gallery->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                        @endif
                    </div>

                        <!-- End of Buttons for actions -->
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No galleries available.</p>
    @endif
</div>
</div>
@endsection
