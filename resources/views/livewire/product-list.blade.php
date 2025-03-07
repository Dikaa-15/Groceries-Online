<div class="relative container mx-auto py-8 px-6 pt-20">
    <div class="relative w-full md:w-full mb-5 md:mb-5">
        <input type="text" wire:model.live="search" placeholder="Cari produk..."
            class="w-full border border-gray-300 py-3 pl-12 pr-4 rounded-lg shadow-md bg-white bg-opacity-60 backdrop-blur-lg text-gray-800 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300">
        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-lg"></i>
    </div>




    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Sidebar Kategori -->
        <div class="lg:col-span-3 md:col-span-12 bg-white bg-opacity-40 backdrop-blur-lg p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Categories</h3>

            <div class="space-y-3">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $cat)
                    <label
                        class="flex items-center space-x-3 cursor-pointer hover:bg-green-100 hover:bg-opacity-30 transition px-3 py-2 rounded-lg">
                        <input type="checkbox" wire:model.live="categories" value="{{ $cat }}"
                            class="w-5 h-5 text-green-500 border-gray-300 rounded-md focus:ring-green-400 accent-green-500">
                        <span class="text-gray-800 font-medium">{{ ucfirst($cat) }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="lg:col-span-9 md:col-span-12">
            <div class="flex flex-col md:flex-row md:justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Products</h2>
                <select wire:model.live="sortBy"
                    class="border px-3 py-2 rounded-lg bg-white bg-opacity-30 backdrop-blur-lg mt-2 md:mt-0">
                    <option value="asc">Price: Low to High</option>
                    <option value="desc">Price: High to Low</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div class="border rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-48 object-cover rounded-t-lg">

                        <div class="p-4">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                                <p class="{{ $product->stock > 0 ? 'text-gray-600' : 'text-red-500 font-bold' }}">
                                    {{ $product->stock > 0 ? "Stock: $product->stock" : 'Out of Stock' }}
                                </p>
                            </div>

                            <div class="flex justify-between items-center mt-2">
                                <p class="text-green-500 font-bold text-lg">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l1.2 5.4m0 0L7 15h10l2.8-6.6M6.2 8.4h11.6M10 21h4m-7-4h10" />
                                    </svg>
                                </button>
                            </div>

                            <a href="{{ url('/products/' . $product->id) }}"
                                class="block text-center bg-green-500 text-white font-medium py-2 mt-4 rounded-md hover:bg-green-600 transition">
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
            <div class="mt-6 flex justify-center space-x-4">
                @if ($products->hasMorePages())
                    <button wire:click="nextPage"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                        &gt;
                    </button>
                @endif

                @if ($products->currentPage() > 1)
                    <button wire:click="previousPage"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                        &lt;
                    </button>
                @endif
            </div>

        </div>
    </div>

    <!-- Banner Section -->
    <div class="relative w-full mt-16 bg-green-600 bg-opacity-80 rounded-xl overflow-hidden shadow-lg">
        <img src="{{ asset('banner/2.jpeg') }}" alt="Fresh Groceries"
            class="w-full h-48 sm:h-64 md:h-72 object-cover opacity-90">

        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center p-6">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white drop-shadow-lg">
                Fresh & Healthy Groceries Delivered to You!
            </h2>
            <p class="text-sm sm:text-lg text-white mt-2 drop-shadow-md">
                Get the best quality fresh produce at unbeatable prices.
            </p>
            <a href="{{ url('/products') }}"
                class="mt-4 px-6 py-2 sm:py-3 bg-green-500 hover:bg-green-600 text-white font-semibold text-sm sm:text-lg rounded-lg shadow-md transition">
                Shop Now
            </a>
        </div>
    </div>

</div>
