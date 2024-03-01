@extends('layouts.app-master')

@section('content')

<div class="container mx-auto my-8">
    <div class="flex flex-col lg:flex-row lg:justify-between">
        <!-- Gambar -->
        <div class="lg:w-1/2 lg:pr-8">
            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Image:</label>
            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="w-full max-h-80 rounded-md object-right">
            <!-- Tombol Like -->
            <div class="mt-4 flex items-center">
                @auth
                    <form id="likeForm" action="{{ route('like.store', ['gallery' => $gallery->id]) }}" method="POST">
                        @csrf
                        <button id="likeButton" type="submit" class="bg-{{ $gallery->isLikedBy(auth()->user()) ? 'red' : 'green' }}-500 text-white px-4 py-2 rounded">
                            @if ($gallery->isLikedBy(auth()->user()))
                                <!-- Jika sudah disukai, tampilkan ikon Unlike -->
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14.5998 8.00033H21C22.1046 8.00033 23 8.89576 23 10.0003V12.1047C23 12.3659 22.9488 12.6246 22.8494 12.8662L19.755 20.3811C19.6007 20.7558 19.2355 21.0003 18.8303 21.0003H2C1.44772 21.0003 1 20.5526 1 20.0003V10.0003C1 9.44804 1.44772 9.00033 2 9.00033H5.48184C5.80677 9.00033 6.11143 8.84246 6.29881 8.57701L11.7522 0.851355C11.8947 0.649486 12.1633 0.581978 12.3843 0.692483L14.1984 1.59951C15.25 2.12534 15.7931 3.31292 15.5031 4.45235L14.5998 8.00033ZM7 10.5878V19.0003H18.1606L21 12.1047V10.0003H14.5998C13.2951 10.0003 12.3398 8.77128 12.6616 7.50691L13.5649 3.95894C13.6229 3.73105 13.5143 3.49353 13.3039 3.38837L12.6428 3.0578L7.93275 9.73038C7.68285 10.0844 7.36341 10.3746 7 10.5878ZM5 11.0003H3V19.0003H5V11.0003Z"/>
                                </svg>
                            @else
                                <!-- Jika belum disukai, tampilkan ikon Like -->
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2 8.99997H5V21H2C1.44772 21 1 20.5523 1 20V9.99997C1 9.44769 1.44772 8.99997 2 8.99997ZM7.29289 7.70708L13.6934 1.30661C13.8693 1.13066 14.1479 1.11087 14.3469 1.26016L15.1995 1.8996C15.6842 2.26312 15.9026 2.88253 15.7531 3.46966L14.5998 7.99997H21C22.1046 7.99997 23 8.8954 23 9.99997V12.1043C23 12.3656 22.9488 12.6243 22.8494 12.8658L19.755 20.3807C19.6007 20.7554 19.2355 21 18.8303 21H8C7.44772 21 7 20.5523 7 20V8.41419C7 8.14897 7.10536 7.89462 7.29289 7.70708Z"/>
                                </svg>
                            @endif
                        </button>
                    </form>
                @else
                    <!-- Jika pengguna belum login, arahkan ke halaman login -->
                    <a href="{{ route('login.show') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                        <!-- Jika belum disukai, tampilkan ikon Like -->
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 8.99997H5V21H2C1.44772 21 1 20.5523 1 20V9.99997C1 9.44769 1.44772 8.99997 2 8.99997ZM7.29289 7.70708L13.6934 1.30661C13.8693 1.13066 14.1479 1.11087 14.3469 1.26016L15.1995 1.8996C15.6842 2.26312 15.9026 2.88253 15.7531 3.46966L14.5998 7.99997H21C22.1046 7.99997 23 8.8954 23 9.99997V12.1043C23 12.3656 22.9488 12.6243 22.8494 12.8658L19.755 20.3807C19.6007 20.7554 19.2355 21 18.8303 21H8C7.44772 21 7 20.5523 7 20V8.41419C7 8.14897 7.10536 7.89462 7.29289 7.70708Z"/>
                        </svg>
                    </a>
                @endauth
                <span id="likeCount" class="text-gray-600 ml-2">{{ $gallery->likesCount() }}</span>
            </div>


        </div>

        <!-- Detail Gallery -->
        <div class="lg:w-1/2 mt-8 lg:mt-0">
            <div class="flex justify-between"><div>
            </div>
            <div class="flex items-center">
                @if($gallery->user->profile_image)
                    <img src="{{ asset('storage/profiles/' . $gallery->user->profile_image) }}" width="30" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                @else
                    <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="mr-2 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-900 border border-solid border-green-700">
                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($gallery->user->username, 0, 1) }}</span>
                    </div>
                @endif
                <p class="text-sm ">{{ $gallery->user->username }}</p>
            </div>

            </div>
            <h1 class="text-5xl">{{ $gallery->title }}</h1>
            <p class="p-2">{{ $gallery->description }}</p>

            @if(count($gallery->albums) > 0)
                @foreach($gallery->albums as $album)
                    <div class="mt-2 p-2">
                        <p class="">Album: {{ $album->title }}</p>
                    </div>
                @endforeach
            @endif

            @if(count($gallery->categories) > 0)
    <div class="mt-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold">Categories:</label>
        <div class="flex flex-wrap">
            @foreach($gallery->categories->take(5) as $category)
                <span class="mr-2 truncate">#{{ $category->name }}</span>
            @endforeach
            @if($gallery->categories->count() > 5)
                <span class="mr-2">...</span>
            @endif
        </div>
    </div>
@endif

            <h3 class="text-xl font-bold mt-4">Comments:</h3>

            <!-- Display existing comments -->
            @forelse ($gallery->comments->take(5) as $comment)
                <div class="mt-2">
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
                    <p class="ml-10 overflow-hidden" >{{ $comment->content }}</p>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

        <!-- Add new comment form if the user is authenticated -->
        @auth
            <form action="{{ route('comments.store', ['gallery' => $gallery->id]) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block dark:text-gray-300 text-gray-700 font-bold">Add Comment:</label>
                    <textarea name="content" id="content" class="w-full p-2 border dark:bg-gray-800 dark:border-gray-600 rounded @error('content') border-red-500 @enderror" required></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Submit Comment</button>
            </form>
        @endauth

        </div>
    </div>
</div>



@endsection
@push('script')
<!-- Script untuk tombol Like -->
<script>
    document.getElementById('likeForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir default

        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                gallery_id: {{ $gallery->id }} // Mengirim ID galeri ke server
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mengubah warna tombol jika belum menyukai galeri
                const likeButton = document.getElementById('likeButton');
                const likeCount = document.getElementById('likeCount');

                if (data.liked) {
                    // Jika berhasil like
                    likeButton.classList.remove('bg-green-500');
                    likeButton.classList.add('bg-red-500');
                    likeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M14.5998 8.00033H21C22.1046 8.00033 23 8.89576 23 10.0003V12.1047C23 12.3659 22.9488 12.6246 22.8494 12.8662L19.755 20.3811C19.6007 20.7558 19.2355 21.0003 18.8303 21.0003H2C1.44772 21.0003 1 20.5526 1 20.0003V10.0003C1 9.44804 1.44772 9.00033 2 9.00033H5.48184C5.80677 9.00033 6.11143 8.84246 6.29881 8.57701L11.7522 0.851355C11.8947 0.649486 12.1633 0.581978 12.3843 0.692483L14.1984 1.59951C15.25 2.12534 15.7931 3.31292 15.5031 4.45235L14.5998 8.00033ZM7 10.5878V19.0003H18.1606L21 12.1047V10.0003H14.5998C13.2951 10.0003 12.3398 8.77128 12.6616 7.50691L13.5649 3.95894C13.6229 3.73105 13.5143 3.49353 13.3039 3.38837L12.6428 3.0578L7.93275 9.73038C7.68285 10.0844 7.36341 10.3746 7 10.5878ZM5 11.0003H3V19.0003H5V11.0003Z"/></svg>`;
                    likeCount.textContent = data.likesCount;
                } else {
                    // Jika berhasil unlike
                    likeButton.classList.remove('bg-red-500');
                    likeButton.classList.add('bg-green-500');
                    likeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M2 8.99997H5V21H2C1.44772 21 1 20.5523 1 20V9.99997C1 9.44769 1.44772 8.99997 2 8.99997ZM7.29289 7.70708L13.6934 1.30661C13.8693 1.13066 14.1479 1.11087 14.3469 1.26016L15.1995 1.8996C15.6842 2.26312 15.9026 2.88253 15.7531 3.46966L14.5998 7.99997H21C22.1046 7.99997 23 8.8954 23 9.99997V12.1043C23 12.3656 22.9488 12.6243 22.8494 12.8658L19.755 20.3807C19.6007 20.7554 19.2355 21 18.8303 21H8C7.44772 21 7 20.5523 7 20V8.41419C7 8.14897 7.10536 7.89462 7.29289 7.70708Z"/></svg>`;
                    likeCount.textContent = data.likesCount;
                }
                console.log(data.liked)
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>


</script>
@endpush
