<aside class="w-64 h-screen bg-gray-900 text-white p-6 flex flex-col shadow-lg">
    {{-- Logo dan Judul Dashboard --}}
    <div class="mb-6 flex items-center space-x-3">
        <span class="text-2xl font-bold">🛒 User Panel</span>
    </div>

    {{-- Menu Navigasi --}}
    <ul class="flex-1 space-y-2">
        <li>
            <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-box"></i>
                <span>Orders</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
    </ul>

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition duration-200">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </form>
</aside>
