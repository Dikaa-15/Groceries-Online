<nav class="fixed top-0 left-0 w-full bg-white shadow-md py-4 px-6 border-b border-gray-200 z-50">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="text-2xl font-semibold">
            <a href="{{ url('/') }}">
                <img src="{{ asset('icon/logo.jpeg') }}" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
        </div>

        <!-- Menu (Laptop) -->
        <ul class="hidden md:flex space-x-8 text-lg text-gray-700">
            <li><a href="{{ url('/') }}" class="hover:text-green-600 transition">Home</a></li>
            <li><a href="{{ url('/products') }}" class="hover:text-green-600 transition">Products</a></li>
            <li><a href="{{ url('/contact') }}" class="hover:text-green-600 transition">Contact Us</a></li>
        </ul>

        <!-- Icons (Profile & Cart) + Auth Buttons -->
        <div class="flex items-center space-x-5">
            @auth
                <a href="{{ url('/profile') }}" class="hover:text-green-600 text-gray-400 transition">
                    <i class="fas fa-user text-xl"></i>
                </a>
                <a href="{{ url('/cart') }}" class="hover:text-green-600 text-gray-400 transition relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2">@livewire('cart-icon')</span>
                </a>
                <!-- <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600 transition">Logout</button>
                </form> -->
            @else
                <a href="{{ url('/login') }}" 
                   class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition duration-300">
                   Login
                </a>
                <a href="{{ url('/register') }}" 
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                   Register
                </a>
            @endauth

            <!-- Hamburger Button (Mobile) -->
            <button class="md:hidden focus:outline-none" @click="open = !open">
                <i class="fas fa-bars text-2xl text-gray-700"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-data="{ open: false }">
        <div x-show="open" class="md:hidden bg-white shadow-md absolute top-16 right-0 w-48 z-50 rounded-lg">
            <ul class="flex flex-col text-lg text-gray-700">
                <li><a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-gray-100">Home</a></li>
                <li><a href="{{ url('/products') }}" class="block px-4 py-2 hover:bg-gray-100">Products</a></li>
                <li><a href="{{ url('/contact') }}" class="block px-4 py-2 hover:bg-gray-100">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>
