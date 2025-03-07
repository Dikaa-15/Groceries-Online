<div class="container mx-auto py-12 px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Gambar Produk -->
        <div>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-full h-96 object-cover rounded-lg shadow-md">
        </div>

        <!-- Detail Produk -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
            <p class="text-green-500 font-bold text-2xl mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-600 mt-4">{{ $product->description }}</p>

            <div class="mt-4 flex items-center">
                <label class="mr-2 font-semibold">Quantity:</label>
                <input type="number" min="1" wire:model="quantity" class="w-16 px-2 py-1 border rounded-md">
            </div>

            <!-- Button Add to Cart & Checkout -->
            <div class="mt-6 flex gap-4">
                <button wire:click="addToCart"
                    class="mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md">
                    Add to Cart
                </button>

                <button wire:click="checkout"
                    class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition">
                    Checkout
                </button>
            </div>

            @if (session()->has('success'))
            <p class="text-green-600 mt-4">{{ session('success') }}</p>
            @endif
        </div>
    </div>
</div>