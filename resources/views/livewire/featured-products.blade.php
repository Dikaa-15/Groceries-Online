<div class="container mx-auto py-12 px-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Sidebar Kategori -->
        <div class="md:col-span-3 col-span-12 bg-white px-5 rounded-lg shadow-md py-5">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Categories Product</h3>
            <div class="space-y-2 text-gray-600 text-lg">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $category)
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" wire:model.live.debounce.500ms="selectedCategories" value="{{ $category }}">
                    <span class="{{ in_array($category, $selectedCategories) ? 'text-green-500 font-bold' : '' }}">
                        {{ ucfirst($category) }}
                    </span>
                </label>
                @endforeach
            </div>
        </div>
        <!-- Produk -->
        <div class="md:col-span-9 col-span-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Featured Products ({{ ucfirst($currentCategory) }})</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @if ($products->isEmpty())
                <div class="col-span-3 text-center text-gray-500 text-lg font-semibold">
                    Products not available in this category.
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
                    class="group relative border rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition">
                    <!-- Gambar Produk -->
                    <div class="relative w-full h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover rounded-t-lg transition duration-300 group-hover:brightness-75">

                        <!-- Eye Icon Saat Hover -->
                        <a href="{{ url('/products/' . strtolower($product->category) . '-' . Str::slug($product->name)) }}"
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black bg-opacity-40">
                            <i class="fas fa-eye text-white text-3xl"></i>
                        </a>
                    </div>

                    <!-- Detail Produk -->
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                            <p class="{{ $product->stock > 0 ? 'text-gray-600' : 'text-red-500 font-bold' }}">
                                {{ $product->stock > 0 ? "Stock: $product->stock" : "Out of Stock" }}
                            </p>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <p class="text-green-500 font-bold text-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="flex items-center">
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
                @endif
            </div>
            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }} <!-- Livewire Pagination -->
            </div>
            <!-- Navigation Buttons for Categories -->
            <div class="flex justify-between mt-6">
                <button wire:click="prevCategory"
                    class="px-4 py-2 bg-gray-300 rounded-md text-gray-700 hover:bg-gray-400 disabled:opacity-50"
                    @if(!$hasPrevCategory) disabled @endif>
                    ← Previous Category
                </button>
                <button wire:click="nextCategory"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 disabled:opacity-50"
                    @if(!$hasNextCategory) disabled @endif>
                    Next Category →
                </button>
            </div>
        </div>
    </div>
    <!-- Notifikasi Add to Cart -->
    <div x-data="{ show: false, message: '' }"
        x-show="show"
        x-transition.duration.500ms
        @cart-updated.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md">
        <span x-text="message"></span>
    </div>
</div>