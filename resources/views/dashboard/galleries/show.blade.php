@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32">
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
        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Created by:</label>
            <p class="p-2 border rounded">{{ $gallery->user->username }}</p>
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

<!-- Like button -->
<div class="mb-4">
    <form id="likeForm" action="{{ route('like.store', ['gallery' => $gallery->id]) }}" method="POST">
        @csrf
        <button id="likeButton" type="submit" class="bg-{{ $gallery->isLikedBy(auth()->user()) ? 'red' : 'green' }}-500 text-white px-4 py-2 rounded">
            {{ $gallery->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}
        </button>
    </form>
    <span id="likeCount" class="text-gray-600">{{ $gallery->likesCount() }}</span>
</div>
<!-- End of Like button -->


    </div>
</div>
@endsection
@push('script')
<script>
    document.getElementById('likeForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

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
                likeButton.textContent = 'Unlike';
                likeCount.textContent = data.likesCount + ' Likes';
            } else {
                // Jika berhasil unlike
                likeButton.classList.remove('bg-red-500');
                likeButton.classList.add('bg-green-500');
                likeButton.textContent = 'Like';
                likeCount.textContent = data.likesCount + ' Likes';
            }
            console.log(data.liked)
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>
@endpush
