@extends('dashboard.layout')

@section('content')
    <div class="lg:ml-64 p-5 mt-20">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-semibold mb-4">Comments</h1>
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md relative">
                <div class="table-wrapper">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white dark:bg-gray-800 table-striped relative">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2 px-3 bg-gray-200 dark:bg-gray-700 font-semibold uppercase text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">User</th>
                                <th class="py-2 px-3 bg-gray-200 dark:bg-gray-700 font-semibold uppercase text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">Comment</th>
                                <th class="py-2 px-3 bg-gray-200 dark:bg-gray-700 font-semibold uppercase text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">Comment At</th>
                                <th class="py-2 px-3 bg-gray-200 dark:bg-gray-700 font-semibold uppercase text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 flex items-center">
                                        <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" class="w-8 h-8 rounded-full mr-2 object-cover" alt="Profile Image">
                                        <span>{{ $comment->user->username }}</span>
                                    </td>
                                    <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">
                                        <a href="{{ route('galleries.show', $comment->gallery_id) }}" class="text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-500">{{ strlen($comment->content) > 50 ? substr($comment->content, 0, 50) . '...' : $comment->content }}</a>
                                    </td>
                                    <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">{{ $comment->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">
                                        <div class="flex justify-center">
                                            @if(auth()->user()->role === 'admin' || auth()->user()->id == $comment->user_id)
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512">
                                                    <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                                </svg>
                                                </a>
                                                <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-500 ml-2 delete-button" data-comment-id="{{ $comment->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512">
                                                    <path fill="currentColor" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                                </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-5 bg-white dark:bg-gray-800 border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    @include('dashboard.comments.delete-comment')

@endsection
