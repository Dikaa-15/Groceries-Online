    <div class="container mx-auto py-20 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Gambar Produk -->
            <div class="md:col-span-1">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-96 object-cover rounded-lg shadow-md">
            </div>

            <!-- Detail Produk -->
            <div class="md:col-span-1">
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                <p class="text-green-500 font-bold text-2xl mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                <!-- Input Quantity -->
                <div class="mt-4 flex items-center">
                    <button wire:click="decreaseQuantity" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-l">−</button>
                    <input type="number" min="1" wire:model="quantity" class="w-16 text-center border-t border-b">
                    <button wire:click="increaseQuantity" class="px-3 py-2 bg-gray-200 hover:bg-gray-300 rounded-r">+</button>
                </div>


                <!-- Button Add to Cart -->
                {{-- <button wire:click="addToCart"
                    class="mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md">
                    Add to Cart
                </button> --}}

                @if (session()->has('success'))
                <p class="text-green-600 mt-4">{{ session('success') }}</p>
                @endif
            </div>

            <!-- Detail Transaction -->
            <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Transaction Details</h2>

                <div class="mb-4">
                    <p class="text-gray-700 text-lg">Product: <span class="font-semibold">{{ $product->name }}</span>
                    </p>
                    <p class="text-gray-700 text-lg">Price: <span class="font-semibold">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</span></p>
                    <p class="text-gray-700 text-lg">Quantity: <span class="font-semibold">{{ $quantity }}</span>
                    </p>
                    <p class="text-gray-700 text-lg mt-4 border-t pt-4">Total Price:
                        <span class="font-semibold text-green-600 text-xl">
                            Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}
                        </span>
                    </p>
                </div>

                <!-- Metode Pembayaran -->
                <h3 class="text-xl font-semibold text-gray-800 mt-6">Payment Method:</h3>
                <div x-data="{ paymentMethod: '' }" class="mt-4 space-y-3">
                    <label
                        class="flex items-center bg-gray-100 p-3 rounded-lg cursor-pointer hover:bg-gray-200 transition border-2 border-transparent"
                        :class="{ 'border-green-500 bg-green-100': paymentMethod === 'bca' }"
                        @click="paymentMethod = 'bca'">
                        <input type="radio" wire:model="paymentMethod" value="bca" class="hidden">
                        <img src="{{ asset('icon/bca.png') }}" alt="BCA" class="w-20 h-10 mr-3">
                        <span class="text-lg font-semibold">BCA</span>
                    </label>

                    <label
                        class="flex items-center bg-gray-100 p-3 rounded-lg cursor-pointer hover:bg-gray-200 transition border-2 border-transparent"
                        :class="{ 'border-green-500 bg-green-100': paymentMethod === 'bri' }"
                        @click="paymentMethod = 'bri'">
                        <input type="radio" wire:model="paymentMethod" value="bri" class="hidden">
                        <img src="{{ asset('icon/bri.png') }}" alt="BRI" class="w-20 h-10 mr-3">
                        <span class="text-lg font-semibold">BRI</span>
                    </label>

                    <label
                        class="flex items-center bg-gray-100 p-3 rounded-lg cursor-pointer hover:bg-gray-200 transition border-2 border-transparent"
                        :class="{ 'border-green-500 bg-green-100': paymentMethod === 'bni' }"
                        @click="paymentMethod = 'bni'">
                        <input type="radio" wire:model="paymentMethod" value="bni" class="hidden">
                        <img src="{{ asset('icon/bni.png') }}" alt="BNI" class="w-20 h-10 mr-3">
                        <span class="text-lg font-semibold">BNI</span>
                    </label>
                </div>


                <!-- Upload Bukti Transfer -->
                <h3 class="text-xl font-semibold text-gray-800 mt-6">Upload Transfer Receipt:</h3>
                <div class="mt-3">
                    <input type="file" wire:model="transferPhoto"
                        class="p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500">
                    @error('transferPhoto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-2">

                    <!-- Button Add to Cart -->
                    <button wire:click="addToCart"
                        class="mt-6 w-1/2 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md">
                        Add to Cart
                    </button>
                    <!-- Checkout Button -->
                    <button wire:click="goToCheckout({{ $product->id }})" wire:loading.attr="disabled"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        Checkout Now
                        <span wire:loading class="animate-spin ml-2">🔄</span>
                    </button>


                </div>
            </div>

        </div>
    </div>