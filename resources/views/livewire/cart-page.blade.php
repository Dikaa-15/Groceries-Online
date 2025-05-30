<div class="container mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4 text-green-600">Keranjang Belanja</h1>

    <!-- Cart Section -->
    <div class="bg-white shadow-md rounded-md p-4 space-y-6">
        <!-- Cart Header -->
        <div class="flex items-center space-x-4 border-b pb-2">
            <input type="checkbox" wire:model="selectAll" class="w-5 h-5 text-green-500 focus:ring-green-500">
            <span class="font-semibold">Pilih Semua</span>
        </div>

        <!-- Cart Items -->
        @foreach ($cartItems as $item)
        <div class="flex items-start space-x-4 border-b pb-4 pt-4">
            <input type="checkbox" wire:model="selectedItems" value="{{ $item->id }}"
                class="mt-4 w-5 h-5 text-green-500 focus:ring-green-500">

            <!-- Product Image -->
            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-20 h-20 object-cover rounded border">

            <!-- Product Info -->
            <div class="flex-1">
                <h2 class="font-semibold text-gray-800">{{ $item->product->name }}</h2>
                <p class="text-sm text-gray-500">Stok: {{ $item->product->stock ?? '-' }}</p>
                <p class="text-sm text-gray-500">Kategori: {{ $item->product->category ?? '-' }}</p>

                <!-- Quantity + Delete -->
                <div class="flex items-center justify-between mt-2">
                    <!-- Quantity Selector -->
                    <div class="flex items-center border rounded">
                        <button wire:click="decrease({{ $item->id }})"
                            class="px-3 py-1 text-gray-600 hover:text-green-600">−</button>
                        <span class="w-10 text-center border-l border-r">{{ $item->quantity }}</span>
                        <button wire:click="increase({{ $item->id }})"
                            class="px-3 py-1 text-gray-600 hover:text-green-600">+</button>
                    </div>

                    <!-- Price and Delete -->
                    <div class="text-right">
                        <p class="text-lg font-semibold text-green-500">
                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </p>
                        <button wire:click="removeItem({{ $item->id }})"
                            class="text-sm text-red-500 hover:underline mt-1">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer Cart Summary -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-md p-4 flex justify-between items-center z-50">
        <div class="flex items-center space-x-4">
            <input type="checkbox" wire:model="selectAll" class="w-5 h-5 text-green-500 focus:ring-green-500">
            <span class="text-sm">Pilih Semua</span>
            <button wire:click="deleteSelected"
                class="text-sm text-red-500 hover:underline"
                @if(count($selectedItems)===0) disabled class="opacity-50 cursor-not-allowed" @endif>
                Hapus
            </button>

        </div>
        <div class="text-right">
            <p class="text-sm text-gray-700">
                Total:
                <span class="text-lg text-green-500 font-bold">
                    Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}
                </span>
            </p>
            <button wire:click="directBuy"
                class="mt-1 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
                Checkout
            </button>


        </div>
    </div>
</div>