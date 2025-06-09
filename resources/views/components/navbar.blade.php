<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-white shadow-md py-4 px-6 border-b border-gray-200 z-50">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="text-2xl font-semibold">
            <a href="{{ url('/') }}">
                <img src="{{ asset('icon/logo.jpeg') }}" alt="Logo" class="w-14 h-14 rounded-full">
            </a>
        </div>

        <!-- Menu (Laptop) -->
        <ul class="hidden md:flex space-x-8 text-lg text-gray-700">
            <li>
                <a href="{{ url('/') }}"
                    class="transition {{ request()->is('/') ? 'text-green-600 font-semibold' : 'hover:text-green-600' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ url('/products') }}"
                    class="transition {{ request()->is('products') ? 'text-green-600 font-semibold' : 'hover:text-green-600' }}">
                    Products
                </a>
            </li>
            <li>
                <a href="{{ url('/contact-us') }}"
                    class="transition {{ request()->is('contact.index') ? 'text-green-600 font-semibold' : 'hover:text-green-600' }}">
                    Contact Us
                </a>
            </li>
        </ul>


        <!-- Icons (Profile & Cart) + Auth Buttons -->
        <div class="flex items-center space-x-5">
            @auth
            @php
            $user = Auth::user();
            $redirectProfile = '/profile';

            if ($user->role === 'admin') {
            $redirectProfile = '/admin';
            } elseif ($user->role === 'user') {
            $redirectProfile = '/dashboard';
            }
            @endphp

            <a href="{{ url($redirectProfile) }}" class="hover:text-green-600 text-gray-400 transition">
                <i class="fas fa-user text-xl"></i>
            </a>

            <a href="{{ url('/cart') }}"
                class="transition relative 
       {{ request()->is('cart') ? 'text-green-600' : 'text-gray-400 hover:text-green-600' }}">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="absolute -top-2 -right-2">@livewire('cart-icon')</span>
            </a>


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
    <div x-show="open" class="md:hidden bg-white shadow-md absolute top-16 right-4 w-48 z-50 rounded-lg"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        <ul class="flex flex-col text-lg text-gray-700">
            <li><a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-gray-100">Home</a></li>
            <li><a href="{{ url('/products') }}" class="block px-4 py-2 hover:bg-gray-100">Products</a></li>
            <li><a href="{{ url('/contact-us') }}" class="block px-4 py-2 hover:bg-gray-100">Contact Us</a></li>
        </ul>
    </div>
</nav>