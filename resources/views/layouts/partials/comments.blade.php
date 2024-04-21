    <div id="comment">
        <div class="flex items-center gap-2 mt-4">
            <span class="">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>
            </span>
            <h3 class="text-xl font-bold">
            {{ Str::limit($totalComments, 999) }} Comments
            </h3>
        </div>
    <!-- Display existing comments -->
    <div class="overflow-y-auto max-h-64"> <!-- Maksimum ketinggian container dan aktifkan overflow scroll -->
        <!-- Display existing comments -->
        @forelse ($gallery->comments as $comment)
            <div class="mt-4 border-b border-gray-200 py-5">
            <div class="flex items-center">
                        <!-- Foto profil pengguna -->
                        @if($comment->user->profile_image)
                            <a href="{{ route('users.show', $comment->user->id) }}">
                                <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                            </a>
                        @else
                            <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                                <span class="w-30 h-30 font-medium text-gray-600 dark:text-gray-300">{{ substr($comment->user->username, 0, 1) }}</span>
                            </div>
                        @endif
                        <!-- Tautan ke profil pengguna -->
                        <p class="font-semibold">
                            <a href="{{ route('users.show', $comment->user->id) }}">
                                @if(!empty(optional($comment->user)->name))
                                    {{ optional($comment->user)->name }}
                                @else
                                    {{ \Illuminate\Support\Str::limit(optional($comment->user)->username, 10) }}
                                @endif
                            </a>
                        </p>
                        <!-- Tampilkan label "Edited" jika komentar pernah diedit -->
                        @if($comment->updated_at != $comment->created_at)
                            <span class="text-xs text-gray-400 ml-2">(Edited)</span>
                        @endif
                        <!-- Tombol edit dan delete jika user adalah admin atau pemilik komentar -->
                        @if(Auth::check() && (Auth::user()->role === 'admin' || $comment->user_id === Auth::id()))
                            <div class="ml-auto flex items-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-500 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512">
                                        <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                    </svg>
                                </a>
                                <!-- Tombol Delete -->
                                <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-500 ml-2 delete-button" data-comment-id="{{ $comment->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                <p class="ml-10">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="mt-4">No comments yet.</p>
        @endforelse
    </div>

    <!-- Add new comment form if the user is authenticated -->
    @if(auth()->check())
        <!-- Form untuk menambahkan komentar jika sudah login -->
        <form action="{{ route('comments.store', ['gallery' => $gallery->id]) }}" method="POST" class="mt-4">
            @csrf
            <div class="flex items-start mb-4">
                <!-- Foto profil pengguna -->
                @if(auth()->user()->profile_image)
                <img src="{{ asset('storage/profiles/' . auth()->user()->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                    @else
                        <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->username, 0, 1) }}</span>
                        </div>
                    @endif

                <!-- Input untuk menambahkan komentar -->
                <textarea name="content" id="content" class="w-full p-2 border dark:bg-gray-800 dark:border-gray-600 rounded focus:outline-none focus:border-blue-500 @error('content') border-red-500 @enderror" placeholder="Add your comment..." required>{{ old('content') }}</textarea>
            </div>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Tombol untuk mengirim komentar -->
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit Comment</button>
        </form>
    @else
        <!-- Pesan untuk pengguna yang belum login -->
        <p class="mt-4">Please <a href="{{ route('login.show') }}" class="text-blue-500">login</a> to add comments.</p>
    @endif
</div>

<!-- modal delete -->
@include('dashboard.comments.delete-comment')


