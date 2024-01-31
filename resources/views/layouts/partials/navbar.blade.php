<header class="bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
  <div class="container mx-auto px-4 py-3">
    <div class="flex justify-between items-center">
      <a href="/" class="text-xl font-bold tracking-wider">Gallery</a>

      <nav>
        <ul class="flex space-x-4">
          <li><a href="#" class="hover:text-gray-200">Home</a></li>
          <li><a href="#" class="hover:text-gray-200">About</a></li>
          <li><a href="#" class="hover:text-gray-200">Services</a></li>
          <li><a href="#" class="hover:text-gray-200">Portfolio</a></li>
          <li><a href="#" class="hover:text-gray-200">Contact</a></li>
        </ul>
      </nav>

      <div class="flex items-center space-x-4">
        @auth
          <span>{{ auth()->user()->name }}</span>
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light">Logout</a>
        @endauth

        @guest
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-yellow">Sign-up</a>
        @endguest
      </div>
    </div>
  </div>
</header>
