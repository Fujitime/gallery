<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">GalleryBit</span>
  </a>

  @auth
  @include('layouts.partials.users-show')
  @endauth
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
            <a href="{{ route('home.index') }}" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700  md:dark:hover:bg-transparent dark:border-gray-700 @if(request()->route()->getName() == 'home.index') text-blue-700  @endif">Home</a>
        </li>
        <li>
            <a href="{{ route('home.about') }}" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700  md:dark:hover:bg-transparent dark:border-gray-700 @if(request()->route()->getName() == 'home.about') text-blue-700  @endif">About</a>
        </li>
        <li>
            <a href="{{ route('guest.albums') }}" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700  md:dark:hover:bg-transparent dark:border-gray-700 @if(request()->route()->getName() == 'guest.albums') text-blue-700  @endif">Album</a>
        </li>
        <li>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700  md:dark:hover:bg-transparent dark:border-gray-700 @if(request()->route()->getName() == 'contact') text-blue-700  @endif">Contact</a>
        </li>
    </ul>
</div>

  @guest

 <div class="flex items-center md:order-2 space-x-3 md:space-x-4 rtl:space-x-reverse">
    @include('layouts.partials.darkmode')
    <a href="{{ route('login.perform') }}" class="py-2 px-3 bg-blue-300 hover:bg-blue-400 text-blue-900 hover:text-gray-900 rounded transition duration-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:hover:text-gray-200">Login</a>
    <a href="{{ route('register.perform') }}" class="py-2 px-3 bg-blue-300 hover:bg-blue-400 text-blue-900 hover:text-gray-900 rounded transition duration-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white dark:hover:text-gray-200">Signup</a>
</div>


@endguest

  </div>
</nav>
