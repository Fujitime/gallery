@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-28">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold">Edit Comment</h2>
            </div>

            <div class="p-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div>
                        @if (file_exists(public_path('storage/' . $gallery->image_path)))
                            <img id="myImg" src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-24 h-24 rounded-md">
                        @else
                            <div class="text-red-500 dark:text-red-400">Image not found</div>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->gallery->caption }}</p>
                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                @if (file_exists(public_path('storage/profiles/' . $comment->user->profile_image)))
                                    <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" class="w-12 h-12 rounded-full" alt="Profile Image">
                                @else
                                    <div class="text-red-500 dark:text-red-400">Profile image not found</div>
                                @endif
                            </div>
                            <div>
                                <p class="text-gray-700 dark:text-gray-300">{{ $comment->user->name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>
                        <div class="max-w-lg">
                            <p class="text-gray-800 dark:text-gray-300 overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content:</label>
                        <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        name="content"
                        id="content"
                        rows="4"
                        maxlength="200"
                        required>{{ $comment->content }}</textarea>
                        @error('content')
                            <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 disabled:opacity-25 transition">Update Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
