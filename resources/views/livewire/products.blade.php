<div class="py-16">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Our Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            @php
            $average = round($product->averageRating(), 1);
            $fullStars = floor($average);
            $halfStar = $average - $fullStars >= 0.5;
            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
            @endphp
            <div
                wire:key="product-{{ $product->id }}"
                class="group relative border rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition">
                <!-- Gambar Produk -->
                <div class="relative w-full h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover rounded-t-lg transition duration-300 group-hover:brightness-75">

                    <!-- Eye Icon Saat Hover -->
                    <a href="{{ url('/products/' . strtolower($product->category) . '/' . Str::slug($product->name)) }}"
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black bg-opacity-40">
                        <i class="fas fa-eye text-white text-3xl"></i>
                    </a>
                </div>

                <!-- Detail Produk -->
                <div class="p-4">
                    <!-- Nama & Stok -->
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="{{ $product->stock > 0 ? 'text-gray-600' : 'text-red-500 font-bold' }}">
                            {{ $product->stock > 0 ? "Stock: $product->stock" : "Out of Stock" }}
                        </p>
                    </div>

                    <!-- Harga & Rating -->
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-green-500 font-bold text-lg">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.117 3.446a1 1 0 00.95.69h3.6c.969 0 1.371 1.24.588 1.81l-2.917 2.12a1 1 0 00-.364 1.118l1.118 3.446c.3.921-.755 1.688-1.54 1.118l-2.917-2.12a1 1 0 00-1.175 0l-2.917 2.12c-.784.57-1.838-.197-1.54-1.118l1.118-3.446a1 1 0 00-.364-1.118L2.394 8.873c-.783-.57-.38-1.81.588-1.81h3.6a1 1 0 00.95-.69l1.117-3.446z" />
                                </svg>
                                @endfor

                                @if ($halfStar)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l2.95 8.963H24l-7.49 5.455L19.9 24 12 18.245V2z" />
                                </svg>
                                @endif

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.117 3.446a1 1 0 00.95.69h3.6c.969 0 1.371 1.24.588 1.81l-2.917 2.12a1 1 0 00-.364 1.118l1.118 3.446c.3.921-.755 1.688-1.54 1.118l-2.917-2.12a1 1 0 00-1.175 0l-2.917 2.12c-.784.57-1.838-.197-1.54-1.118l1.118-3.446a1 1 0 00-.364-1.118L2.394 8.873c-.783-.57-.38-1.81.588-1.81h3.6a1 1 0 00.95-.69l1.117-3.446z" />
                                    </svg>
                                    @endfor

                                    <span class="text-sm text-gray-500 ml-2">({{ $average }})</span>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <!-- Tombol Shop Now! -->
                    <button
                        wire:click="directBuy({{ $product->id }})"
                        @disabled($product->stock == 0)
                        class="w-full font-medium py-2 mt-4 rounded-md transition
                        {{ $product->stock == 0 
            ? 'bg-gray-400 text-white cursor-not-allowed' 
            : 'bg-green-500 text-white hover:bg-green-600' }}"
                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                        {{ $product->stock == 0 ? 'Out of Stock' : 'Shop Now!' }}
                    </button>

                </div>
            </div>
            @endforeach
        </div>


        <div class="text-center mt-8">
            <a href="/products"
                class="px-6 py-3 bg-green-500 text-white rounded-lg text-lg font-semibold hover:bg-green-600">
                All Products
            </a>
        </div>
    </div>
</div>