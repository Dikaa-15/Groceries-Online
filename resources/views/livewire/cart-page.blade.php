<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>

    <div class="bg-white p-4 shadow-md rounded-lg">
        @foreach ($cartItems as $item)
        <div class="flex items-center border-b py-4 relative">
            <!-- Checkbox -->
            <input type="checkbox" wire:model="selectedItems" value="{{ $item->id }}" class="w-5 h-5 border-gray-300 rounded mr-3">

            <!-- Image -->
            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                class="w-20 h-20 object-cover rounded-lg mr-4">

            <!-- Product Info -->
            <div class="flex-1 sm:mb-2 md:mb-0">
                <h3 class="font-semibold text-sm sm:text-base">{{ $item->product->name }}</h3>
                <p class="text-gray-500 text-sm sm:text-base">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
            </div>

            <!-- Quantity Control (dikanan bawah) -->
            <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                <button wire:click="decrease({{ $item->id }})"
                    class="bg-green-600 text-white px-3 py-1 rounded-l">-</button>
                <span class="px-4 py-1 border w-10 text-center">{{ $item->quantity }}</span>
                <button wire:click="increase({{ $item->id }})"
                    class="bg-green-600 text-white px-3 py-1 rounded-r">+</button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Checkout Button -->
    <div class="flex justify-end mt-6">
        <button wire:click="goToCheckout" class="bg-green-600 text-white px-6 py-3 rounded-lg">
            Checkout
        </button>
    </div>
</div>
