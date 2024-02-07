<!-- File: resources/views/galleries/show.blade.php -->

@extends('layouts.app-master')

@section('content')
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Gallery Details</h2>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Title:</label>
            <p class="p-2 border rounded">{{ $gallery->title }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Description:</label>
            <p class="p-2 border rounded">{{ $gallery->description }}</p>
        </div>

        @if(count($gallery->albums) > 0)
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Albums:</label>
                @foreach($gallery->albums as $album)
                    <p class="p-2 border rounded">{{$album->title}}</p>
                    <p class="p-2 border rounded">{{$album->description}}</p>
                @endforeach
            </div>
        @endif

        @if(count($gallery->categories) > 0)
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Categories:</label>
                @foreach($gallery->categories as $category)
                    <p class="p-2 border rounded">{{ $category->name }}</p>
                @endforeach
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Image:</label>
            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="w-full">
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-bold mb-2">Comments:</h3>

            <!-- Display existing comments -->
            @forelse ($gallery->comments as $comment)
                <div class="mb-2">
                    <p class="font-semibold">{{ optional($comment->user)->username }}</p>
                    <p>{{ $comment->content }}</p>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

            <!-- Add new comment form if the user is authenticated -->
            @auth
                <form action="{{ route('comments.store', ['gallery' => $gallery->id]) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-bold">Add Comment:</label>
                        <textarea name="content" id="content" class="w-full p-2 border rounded" required></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">Submit Comment</button>
                </form>
            @endauth
        </div>
    </div>
@endsection

