    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>

        <div class="bg-white p-4 shadow-md rounded-lg">
            @foreach ($cartItems as $item)
            <div class="flex items-center border-b py-4">
                <input type="checkbox" wire:model="selectedItems" value="{{ $item->id }}" class="mr-4 w-5 h-5 border-gray-300 rounded">
                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                    class="w-16 h-16 object-cover mr-4">

                <div class="flex-1">
                    <h3 class="font-semibold">{{ $item->product->name }}</h3>
                    <p class="text-gray-500">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="flex items-center space-x-2">
                    <button wire:click="decrease({{ $item->id }})"
                        class="bg-green-600 text-white px-2 py-1 rounded-l">-</button>
                    <span class="px-4 py-1 border">{{ $item->quantity }}</span>
                    <button wire:click="increase({{ $item->id }})"
                        class="bg-green-600 text-white px-2 py-1 rounded-r">+</button>
                </div>

                <button class="ml-4 text-red-500" wire:click="removeItem({{ $item->id }})">
                    Remove
                </button>
            </div>
            @endforeach
        </div>

        <div class="flex justify-end mt-6">
            <button wire:click="goToCheckout" class="bg-green-600 text-white px-6 py-3 rounded-lg">
                Checkout
            </button>

        </div>
    </div>