@extends('dashboard.layout')

@section('content')
<div class="lg:ml-64 p-5 mt-28">
    {{ Breadcrumbs::render('galleries.action') }}
    <h2 class="text-2xl font-bold mb-4">Gallery List</h2>
    <a href="{{ route('galleries.create') }}" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200 mb-4 inline-block">Add New Gallery</a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Author</th>
                    <th scope="col" class="px-6 py-3">Image</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galleries as $gallery)
                    @php
                        $author = $gallery->user ? $gallery->user->username : __('Null');
                        $authorProfileImage = $gallery->user ? asset('storage/profiles/' . $gallery->user->profile_image) : null;
                    @endphp
                    @if (Auth::user()->role === 'admin' || $gallery->user_id === Auth::id())
                        <tr>
                            <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('galleries.show', $gallery->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">{{ $gallery->title }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                @if ($gallery->user->profile_image)
                            <img src="{{ $gallery->user->profile_image ? asset('storage/profiles/' . $gallery->user->profile_image) : '' }}" class="w-8 h-8 rounded-full mr-2" alt="Profile Image">
                        @else
                            <div class="w-8 h-8 mr-2 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="font-medium text-gray-600 dark:text-gray-800">{{ substr($gallery->user->username ?? __('Null'), 0, 1) }}</span>
                            </div>
                        @endif
                                    <a href="{{ route('users.show', $gallery->user_id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">{{ $author }}</a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-20 h-20 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('galleries.show', $gallery->id) }}">
                                    <button type="button" class="flex items-center space-x-2 text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                        </svg>
                                    </button>
                                </a>
                                <a href="{{ route('galleries.edit', $gallery->id) }}">
                                    <button type="button" class="flex items-center space-x-2 text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 576 512">
                                            <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                        </svg>
                                    </button>
                                </a>
                                <button type="button" class="delete-button flex items-center space-x-2 text-red-500 hover:underline" data-gallery-id="{{ $gallery->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No galleries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="bg-gray-100 dark:bg-gray-800 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $galleries->links() }}
        </div>
    </div>
</div>

<!-- Delete confirmation modal -->
<div id="deleteModal" class="fixed top-0 left-0 w-full h-full z-20 bg-opacity-90 backdrop-filter backdrop-blur-lg hidden">
    <div class="flex justify-center items-center h-full">
        <div class="dark:bg-gray-900 bg-gray-200 shadow dark:shadow-none p-5 rounded-lg">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-gray-100 dark:bg-gray-800 rounded-lg sm:p-5">
                <button id="cancelButton" type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <h2 class="text-lg font-semibold mb-4">Delete Confirmation</h2>
                <svg class="text-red-700 w-11 h-11 mb-3.5 mx-auto animate-bounce" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <p class="mb-4">Are you sure you want to delete this gallery?</p>
                <div class="flex justify-end">
                    <form id="deleteForm" method="POST" action="{{ route('galleries.destroy', '__gallery_id__') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-button');

    // Get delete modal and its inner elements
    const deleteModal = document.getElementById('deleteModal');
    const cancelButton = document.getElementById('cancelButton');
    const deleteForm = document.getElementById('deleteForm');

    // Add event listener to each delete button
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const galleryId = button.dataset.galleryId;
            deleteForm.action = '{{ route("galleries.destroy", ":gallery_id") }}'.replace(':gallery_id', galleryId);
            deleteModal.classList.remove('hidden');
        });
    });

    // Add event listener to cancel button
    cancelButton.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
</script>
@endpush
