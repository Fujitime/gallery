    <!-- Delete confirmation modal -->
    <div id="deleteModal" class="fixed top-0 left-0 w-full h-full z-20 bg-opacity-90 backdrop-filter backdrop-blur-lg hidden">
        <div class="flex justify-center items-center h-full">
            <div class="dark:bg-gray-900 bg-gray-200 shadow dark:shadow-none p-5 rounded-lg">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-gray-100 dark:bg-gray-800 rounded-lgsm:p-5">
                    <button id="cancelButton" type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <h2 class="text-lg font-semibold mb-4">Delete Confirmation</h2>
                    <svg class="text-red-700 w-11 h-11 mb-3.5 mx-auto animate-bounce" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4">Are you sure you want to delete this comment?</p>
                    <div class="flex justify-end">
                        <form id="deleteForm" method="POST" action="{{ route('comments.destroy', '__comment_id__') }}">
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
                const commentId = button.dataset.commentId;
                deleteForm.action = deleteForm.action.replace('__comment_id__', commentId);
                deleteModal.classList.remove('hidden');
            });
        });

        // Add event listener to cancel button
        cancelButton.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });
    </script>
    @endpush
