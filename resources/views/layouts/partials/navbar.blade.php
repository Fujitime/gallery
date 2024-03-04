<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Gallery</span>
  </a>

  @auth
  @include('layouts.partials.users-show')
  @endauth

  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
      <a href="{{ route('home.index') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
    </li>
      <li>
        <a href="{{ route('guest.albums') }}"class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
        Album
        </a>
      </li>
      <li>
        <a href="{{ route('guest.albums') }}"class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
        Album
        </a>
      </li>

    </ul>
  </div>
  @guest

 <div class="flex items-center md:order-2 space-x-3 md:space-x-4 rtl:space-x-reverse">
    @include('layouts.partials.darkmode')
    <a href="{{ route('login.perform') }}" class="py-2 px-3 bg-blue-400 hover:bg-blue-300 text-blue-900 hover:text-blue-800 rounded transition duration-300 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white dark:hover:text-gray-200">Login</a>
    <a href="{{ route('register.perform') }}" class="py-2 px-3 bg-blue-400 hover:bg-blue-300 text-blue-900 hover:text-blue-800 rounded transition duration-300 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white dark:hover:text-gray-200">Signup</a>
</div>


@endguest

  </div>
</nav>
