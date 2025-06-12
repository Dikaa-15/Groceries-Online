<div class="relative container mx-auto py-8 px-6 pt-20">
    <!-- Search Bar -->
    <div class="relative w-full md:w-full mb-5">
        <div class="relative">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari produk..."
                class="w-full border border-gray-300 py-3 pl-10 pr-4 rounded-lg shadow-xl bg-white/50 backdrop-blur-md text-gray-900 focus:ring-4 focus:ring-green-500/50 focus:border-green-500 transition-all duration-300">
            <span class="absolute inset-y-0 left-3 flex items-center">
                <i class="fas fa-search text-gray-600 text-lg"></i>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Sidebar Kategori -->
        <div class="lg:col-span-3 bg-white/50 backdrop-blur-md p-6 rounded-2xl shadow-xl">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Categories</h3>
            <div class="space-y-3">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $cat)
                <label
                    class="flex items-center space-x-3 cursor-pointer px-4 py-3 rounded-lg transition duration-300 bg-white/60 hover:bg-green-200 focus-within:bg-green-300 {{ in_array($cat, $categories) ? 'bg-green-300' : '' }}">
                    <input type="checkbox" wire:model.live="categories" value="{{ $cat }}"
                        class="w-5 h-5 text-green-500 border-gray-300 rounded-md focus:ring-green-400 accent-green-500">
                    <span class="text-gray-800 font-medium">{{ ucfirst($cat) }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="lg:col-span-9">
            

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($products as $product)
                <div wire:key="product->{{ $product->id }}"
                    x-data="{ show: false }"
                    x-intersect.once="show = true"
                    class="border rounded-2xl shadow-lg bg-white hover:shadow-2xl transition-all transform hover:scale-105 
                    duration-500 ease-in-out opacity-0 translate-y-10"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                    <img loading="lazy" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-56 object-cover rounded-t-2xl transition-all duration-300 hover:opacity-80">

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $product->name }}</h3>
                        <p class="{{ $product->stock > 0 ? 'text-gray-600' : 'text-red-500 font-bold' }}">
                            {{ $product->stock > 0 ? "Stock: $product->stock" : 'Out of Stock' }}
                        </p>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-green-500 font-bold text-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                        </div>

                        <a href="{{ url('/products/' . $product->id) }}"
                            class="block text-center bg-green-500 text-white font-medium py-2 mt-4 rounded-lg hover:bg-green-600 transition">
                            Shop Now!
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-500 text-lg font-semibold">
                    No products available
                </div>
                @endforelse
            </div>




            <!-- Custom Pagination -->
            <div class="mt-14 flex justify-center space-x-4">
                @if ($products->hasMorePages())
                <button wire:click="nextPage"
                    class="bg-green-500 text-white px-5 py-3 rounded-lg hover:bg-green-600 transition">
                    &gt;
                </button>
                @endif

                @if ($products->currentPage() > 1)
                <button wire:click="previousPage"
                    class="bg-green-500 text-white px-5 py-3 rounded-lg hover:bg-green-600 transition">
                    &lt;
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Banner Section -->
    <div class="relative w-full mt-16 bg-green-600 bg-opacity-90 rounded-2xl overflow-hidden shadow-2xl animate-fadeIn">
        <img src="{{ asset('banner/2.jpeg') }}" alt="Fresh Groceries"
            class="w-full h-48 sm:h-64 md:h-80 object-cover opacity-80 transition-all duration-500 hover:opacity-100">
        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center p-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-white drop-shadow-lg">
                Fresh & Healthy Groceries Delivered to You!
            </h2>
            <p class="text-sm sm:text-lg text-white mt-2 drop-shadow-md">
                Get the best quality fresh produce at unbeatable prices.
            </p>
            <a href="{{ url('/products') }}"
                class="mt-4 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold text-lg rounded-xl shadow-md transition">
                Shop Now
            </a>
        </div>
    </div>
</div>