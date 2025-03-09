<div class="container mx-auto py-12 px-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Sidebar Kategori -->
        <div class="md:col-span-3 col-span-12 bg-white px-5 rounded-lg shadow-md py-5">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Categories Product</h3>
            <div class="space-y-2 text-gray-600 text-lg">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $category)
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category }}"
                        class="rounded text-green-500 focus:ring-green-500">
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
                <div x-data="{ added: false }" class="border rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-48 object-cover rounded-t-lg">

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
</div>