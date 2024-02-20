<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    @auth
        <div class="flex items-center space-x-3">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 capitalize ">{{ auth()->user()->role }}</span>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                @if(auth()->check() && auth()->user()->profile_image)
                    <img src="{{ asset('storage/profiles/' . auth()->user()->profile_image) }}" width="30" class="rounded-full inline-block w-10 h-10 overflow-hidden bg-gray-100 dark:bg-gray-600 border border-solid border-green-700" alt="Profile Image">
                @else
                    <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600 border border-solid border-green-700">
                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->username, 0, 1) }}</span>
                    </div>
                @endif
            </button>
        </div>
    @endauth

    <!-- Dropdown menu -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
            <div class="truncate">{{ auth()->user()->username }}</div>
            <div class="font-medium truncate">{{ auth()->user()->email }}</div>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            @if(!request()->is('dashboard'))
                <li>
                    <a href="{{ route('dashboard')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                </li>
            @endif

            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
            </li>

            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
            </li>
            <li>
                <a href="{{ route('logout.perform') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
            </li>
        </ul>
    </div>

    @php
        $excludedRoutes = ['dashboard', 'galleries', 'profile', 'albums', 'categories', 'users'];
        $regex = '/' . implode('|', $excludedRoutes) . '/';
    @endphp

    @if (!preg_match($regex, request()->path()))
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    @endif
</div>
