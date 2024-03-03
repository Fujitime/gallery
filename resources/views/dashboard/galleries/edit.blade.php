@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-32 dark:bg-gray-800">
{{ Breadcrumbs::render('galleries.edit', $gallery) }}
@auth
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Edit Gallery</h2>

        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <label for="title" class="block text-gray-700 font-bold dark:text-gray-300">Title:</label>
                    <input type="text" name="title" id="title" value="{{ $gallery->title }}" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>


                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-gray-700 font-bold dark:text-gray-300">Categories:</label>
                    @foreach ($categories as $category)
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, $gallery->categories->pluck('id')->toArray()) ? 'checked' : '' }} class="mr-2">
                            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>


                <div class="col-span-2 sm:col-span-1">
                    <label for="description" class="block text-gray-700 font-bold dark:text-gray-300">Description:</label>
                    <textarea name="description" id="description" class="w-full p-2 border rounded focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ $gallery->description }}</textarea>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label class="block text-gray-700 font-bold dark:text-gray-300">Albums:</label>
                    @foreach ($albums as $album)
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="albums[]" id="album_{{ $album->id }}" value="{{ $album->id }}" {{ in_array($album->id, $gallery->albums->pluck('id')->toArray()) ? 'checked' : '' }} class="mr-2">
                            <label for="album_{{ $album->id }}">{{ $album->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-span-2">
                    <label for="image" class="block text-gray-700 font-bold dark:text-gray-300">Image:</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full">
                    <p class="text-sm text-gray-500 mt-2 dark:text-gray-400">Leave empty if you don't want to change the image.</p>
                </div>

                <div class="col-span-2">
                    <img id="preview" src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image Preview" class="mt-2 mx-auto">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700 focus:outline-none focus:bg-blue-700 mx-auto mt-4 block">Update</button>
        </form>
    </div>
@else
    <p class="text-red-500 dark:text-red-400">You must be logged in to access this page.</p>
@endauth

</div>
@endsection

@push('script')
<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                imagePreview.src = reader.result;
            });

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
        }
    });
</script>
@endpush
