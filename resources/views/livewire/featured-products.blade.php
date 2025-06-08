<div class="container mx-auto py-8 px-4 sm:px-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Sidebar Kategori - Modernized -->
        <div class="md:col-span-3 col-span-12 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100">Filter Products</h3>
            <div class="space-y-3">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $category)
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="checkbox" wire:model.live.debounce.500ms="selectedCategories" value="{{ $category }}"
                        class="rounded text-green-600 border-gray-300 focus:ring-green-500 h-5 w-5 transition">
                    <span class="text-gray-700 group-hover:text-gray-900 transition-colors
                        {{ in_array($category, $selectedCategories) ? 'text-green-600 font-medium' : '' }}">
                        {{ ucfirst($category) }}
                    </span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Produk - Modernized -->
        <div class="md:col-span-9 col-span-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Products <span class="text-green-600">({{ ucfirst($currentCategory) }})</span></h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if ($products->isEmpty())
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-400 text-lg font-medium mb-2">No products found</div>
                    <p class="text-gray-500">Try adjusting your filters or check back later</p>
                </div>
                @else
                @foreach ($products as $product)
                @php
                $average = $product->rates_avg_rate ?? 0;
                $fullStars = floor($average);
                $halfStar = ($average - $fullStars) >= 0.5;
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
                        <a href="{{ url('/products/' . strtolower($product->category) . '-' . Str::slug($product->name)) }}"
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 bg-black bg-opacity-20">
                            <div class="bg-white rounded-full p-3 shadow-lg transform transition-transform duration-300 group-hover:scale-110">
                                <i class="fas fa-eye text-green-600 text-xl"></i>
                            </div>
                        </a>
                    </div>

                    <!-- Detail Produk -->
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $product->name }}</h3>
                            <p class="{{ $product->stock > 0 ? 'text-gray-500 text-sm' : 'text-red-500 font-medium text-sm' }}">
                                {{ $product->stock > 0 ? "In Stock" : "Out of Stock" }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <p class="text-green-600 font-bold text-xl mb-3">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="flex items-center mb-4">
                                {{-- Full Stars --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.117 3.446a1 1 0 00.95.69h3.6c.969 0 1.371 1.24.588 1.81l-2.917 2.12a1 1 0 00-.364 1.118l1.118 3.446c.3.921-.755 1.688-1.54 1.118l-2.917-2.12a1 1 0 00-1.175 0l-2.917 2.12c-.784.57-1.838-.197-1.54-1.118l1.118-3.446a1 1 0 00-.364-1.118L2.394 8.873c-.783-.57-.38-1.81.588-1.81h3.6a1 1 0 00.95-.69l1.117-3.446z" /></svg>
                                    @endfor

                                    {{-- Half Star --}}
                                    @if ($halfStar)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l2.95 8.963H24l-7.49 5.455L19.9 24 12 18.245V2z" />
                                    </svg>
                                    @endif

                                    {{-- Empty Stars --}}
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.117 3.446a1 1 0 00.95.69h3.6c.969 0 1.371 1.24.588 1.81l-2.917 2.12a1 1 0 00-.364 1.118l1.118 3.446c.3.921-.755 1.688-1.54 1.118l-2.917-2.12a1 1 0 00-1.175 0l-2.917 2.12c-.784.57-1.838-.197-1.54-1.118l1.118-3.446a1 1 0 00-.364-1.118L2.394 8.873c-.783-.57-.38-1.81.588-1.81h3.6a1 1 0 00.95-.69l1.117-3.446z" /></svg>
                                        @endfor

                                        <span class="text-sm text-gray-500 ml-2">({{ number_format($average, 1) }})</span>
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
                            {{ $product->stock == 0 ? 'Out of Stock' : 'Buy Now' }}
                        </button>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>

            <!-- Navigation Buttons for Categories -->
            <div class="flex justify-between mt-8">
                <button wire:click="prevCategory"
                    class="px-5 py-2.5 bg-white text-gray-700 rounded-lg hover:bg-gray-50 disabled:opacity-50 transition-all duration-300 border border-gray-200 hover:border-gray-300 flex items-center gap-2"
                    @if(!$hasPrevCategory) disabled @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                <button wire:click="nextCategory"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 transition-all duration-300 hover:shadow-md flex items-center gap-2"
                    @if(!$hasNextCategory) disabled @endif>
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Notifikasi Add to Cart -->
    <div x-data="{ show: false, message: '' }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        @cart-updated.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span x-text="message" class="font-medium"></span>
    </div>
</div>