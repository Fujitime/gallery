<!-- Logout confirmation modal -->
<div id="logoutModal" class="fixed top-0 left-0 w-full h-full z-20 bg-opacity-90 backdrop-filter backdrop-blur-lg hidden">
    <div class="flex justify-center items-center h-full">
        <div class="dark:bg-gray-900 bg-gray-200 shadow dark:shadow-none p-5 rounded-lg">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-gray-100 dark:bg-gray-800 rounded-lg sm:p-5">
                <button id="cancelLogoutButton" type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="logoutModal">
                    <svg aria-hidden="true" class="w-5 h" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <h2 class="text-lg font-semibold mb-4">Logout Confirmation</h2>
                <p class="mb-4">Are you sure you want to logout?</p>
                <div class="flex justify-end">
                    <a href="{{ route('logout.perform') }}" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, Logout
                    </a>
                    <button id="cancelLogoutButton" type="button" class="py-2 px-3 ml-2 text-sm font-medium text-center text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-400 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<li class="{{ request()->routeIs('logout.perform') ? 'bg-gray-200 dark:bg-gray-500 rounded-lg' : '' }}">
    <a href="#" onclick="showLogoutModal(event)" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
        </svg>
        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
    </a>
</li>

@push('script')
<script>
    function showLogoutModal(event) {
        event.preventDefault();
        const logoutModal = document.getElementById('logoutModal');
        logoutModal.classList.remove('hidden');
    }

    // Get logout modal and cancel button
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogoutButton = document.getElementById('cancelLogoutButton');

    // Add event listener to cancel button
    cancelLogoutButton.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
    });
</script>
@endpush
