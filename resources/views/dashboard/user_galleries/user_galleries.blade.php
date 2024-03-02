    <div class="container mx-auto my-8">
        @if(!is_null($userGalleries) && count($userGalleries) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($userGalleries as $gallery)
                    <div class="relative bg-white rounded overflow-hidden shadow-md">
                        <!-- Tambahkan tautan untuk masuk ke detail gambar -->
                        <a href="{{ route('galleries.show', $gallery->id) }}">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No galleries available.</p>
        @endif
    </div>
