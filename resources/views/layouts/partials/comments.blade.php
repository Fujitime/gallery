<div id="comment" >
                    <h3 class="text-xl font-bold mt-4">{{$totalComments}} Comments</h3>
                    <!-- Display existing comments -->
                    <div class="overflow-y-auto max-h-64"> <!-- Maksimum ketinggian container dan aktifkan overflow scroll -->
                    <!-- Display existing comments -->
                    @forelse ($gallery->comments as $comment)
                        <div class="mt-4 border-b border-gray-200"> <!-- Atur jarak antara komentar dan tambahkan garis bawah -->
                            <div class="flex items-center">
                                @if($comment->user->profile_image)
                                    <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                                @else
                                    <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($comment->user->username, 0, 1) }}</span>
                                    </div>
                                @endif
                                <p class="font-semibold">{{ optional($comment->user)->username }}</p>
                            </div>
                            <p class="ml-10">{{ $comment->content }}</p> <!-- Tambahkan padding kiri untuk konten komentar -->
                        </div>
                    @empty
                        <p class="mt-4">No comments yet.</p> <!-- Atur jarak dari atas -->
                    @endforelse
                </div>

                <!-- Add new comment form if the user is authenticated -->
                @if(auth()->check())
                <!-- Form untuk menambahkan komentar jika sudah login -->
                <form action="{{ route('comments.store', ['gallery' => $gallery->id]) }}" method="POST" class="mt-4">
                @csrf
                    <div class="flex items-start mb-4">
                        <!-- Foto profil pengguna -->
                        <img src="{{ asset('storage/profiles/' . auth()->user()->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                        <!-- Input untuk menambahkan komentar -->
                        <textarea name="content" id="content" class="w-full p-2 border dark:bg-gray-800 dark:border-gray-600 rounded focus:outline-none focus:border-blue-500 @error('content') border-red-500 @enderror" placeholder="Add your comment..." required></textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol untuk mengirim komentar -->
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit Comment</button>
                </form>
            @else
                <!-- Pesan untuk pengguna yang belum login -->
                <p class="mt-4">Please <a href="{{ route('login.show') }}" class="text-blue-500">login</a> to add comments.</p>
            @endif
                </div>
