<div class="py-12">
    <div class="container mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold mb-10 text-gray-900">Recommendation Products</h2>

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
                class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-green-100">
                <!-- Gambar Produk -->
                <div class="relative w-full aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <!-- Eye Icon Saat Hover -->
                    <a href="{{ url('/products/' . strtolower($product->category) . '-' . ($product->name)) }}"
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 bg-black bg-opacity-20">
                        <div class="bg-white rounded-full p-3 shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                            <i class="fas fa-eye text-green-600 text-xl"></i>
                        </div>
                    </a>
                </div>
                

                <!-- Detail Produk -->
                <div class="p-5">
                    <!-- Nama & Stok -->
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $product->name }}</h3>
                        <p class="{{ $product->stock > 0 ? 'text-gray-500 text-sm' : 'text-red-500 font-medium text-sm' }}">
                            {{ $product->stock > 0 ? "In Stock" : "Out of Stock" }}
                        </p>
                    </div>

                    <!-- Harga & Rating -->
                    <div class="mt-4">
                        <p class="text-green-600 font-bold text-xl mb-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center mb-4">
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

                    <!-- Tombol Shop Now! -->
                    <button
                        wire:click="directBuy({{ $product->id }})"
                        @disabled($product->stock == 0)
                        class="w-full font-medium py-3 rounded-lg transition-all duration-300
                        {{ $product->stock == 0 
                            ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
                            : 'bg-green-600 text-white hover:bg-green-700 hover:shadow-md active:scale-95' }}"
                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                        {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="/products"
                class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition-all duration-300 hover:shadow-md">
                View All Products
            </a>
        </div>
    </div>
</div>