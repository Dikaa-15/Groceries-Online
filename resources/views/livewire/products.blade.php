<div class="py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Our Products</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="border rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-48 object-cover rounded-t-lg">

                <div class="p-4">
                    <!-- Nama & Stok dalam satu baris -->
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="{{ $product->stock > 0 ? 'text-gray-600' : 'text-red-500 font-bold' }}">
                            {{ $product->stock > 0 ? "Stock: $product->stock" : "Out of Stock" }}
                        </p>
                    </div>

                    <!-- Harga & Icon Cart dalam satu baris -->
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-green-500 font-bold text-lg">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <div x-data="{ show: false }" class="relative">
                            <button
                                wire:click="addToCart({{ $product->id }})"
                                @click="show = true; setTimeout(() => show = false, 1500)"
                                class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l1.2 5.4m0 0L7 15h10l2.8-6.6M6.2 8.4h11.6M10 21h4m-7-4h10" />
                                </svg>
                            </button>

                            <!-- Animasi +1 -->
                            <span x-show="show"
                                x-transition.opacity.duration.1000ms
                                x-transition:enter="transform translate-y-2 opacity-0 scale-75"
                                x-transition:enter-end="transform translate-y-[-10px] opacity-100 scale-100"
                                x-transition:leave="transform translate-y-[-10px] opacity-100 scale-100"
                                x-transition:leave-end="transform translate-y-[-20px] opacity-0 scale-75"
                                class="absolute top-0 right-0 text-green-500 font-bold text-lg">
                                +1
                            </span>
                        </div>

                    </div>

                    <a href="{{ url('/products/' . $product->id) }}"
                        class="block text-center bg-green-500 text-white font-medium py-2 mt-4 rounded-md hover:bg-green-600 transition">
                        Shop Now!
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="/products" class="px-6 py-3 bg-green-500 text-white rounded-lg text-lg font-semibold hover:bg-green-600">
                All Products
            </a>
        </div>
    </div>
</div>