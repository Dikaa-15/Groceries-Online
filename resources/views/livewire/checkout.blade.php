<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6 md:p-10 space-y-8 mt-16">
    <!-- Informasi Pengiriman - Enhanced Section -->
    <section class="space-y-6">
        <Informasi class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Informasi Pengiriman</h2>
        <div class="bg-gray-50 p-6 rounded-xl shadow-sm space-y-3">
            <p class="font-medium text-gray-700">Nama: <span class="text-gray-900">{{ Auth::user()->name }}</span></p>
            <p class="text-gray-700">Alamat: <span class="text-gray-900">{{ Auth::user()->personalData->address }}</span></p>
            <p class="text-gray-700">No. HP: <span class="text-gray-900">{{ Auth::user()->phone_number }}</span></p>
        </div>
    </section>

    <!-- Daftar Produk - Enhanced Product List -->
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Produk yang Dibeli</h2>
        <div class="space-y-4">
            @foreach ($cartItems as $index => $item)
            <div class="flex items-center justify-between p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-100">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="Produk" class="w-20 h-20 object-cover rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                        <div class="flex items-center space-x-2 mt-2">
                            <button wire:click.prevent="decrementQuantity({{ $index }})"
                                class="px-3 py-1 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-150 active:scale-95">
                                -
                            </button>
                            <span class="px-3 py-1 border rounded-lg bg-white text-center min-w-[40px]">{{ $item->quantity }}</span>
                            <button wire:click.prevent="incrementQuantity({{ $index }})"
                                class="px-3 py-1 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-150 active:scale-95">
                                +
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-right font-semibold text-green-600 text-lg">
                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Payment Sections Grid -->
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Metode Pembayaran - Enhanced -->
        <section class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Metode Pembayaran</h2>
            <select wire:model.defer="paymentMethod"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 focus:outline-none transition">
                <option value="">Pilih Pembayaran</option>
                <option value="bca">Transfer Bank (BCA)</option>
                <option value="bri">Transfer Bank (BRI)</option>
                <option value="bni">Transfer Bank (BNI)</option>
            </select>
            @error('paymentMethod')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </section>

        <!-- Upload Bukti Transfer - Enhanced -->
        <section class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2">Upload Bukti Transfer</h2>
            <div class="relative">
                <input type="file" wire:model="transfer_poto"
                    class="w-full p-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
            </div>
            @error('transfer_poto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </section>
    </div>

    <!-- Ringkasan Pembayaran - Enhanced -->
    <section class="bg-gray-50 p-6 rounded-xl shadow-sm space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Ringkasan Pembayaran</h2>
            <span class="text-2xl font-bold text-green-600">
                Rp{{ number_format($totalPrice, 0, ',', '.') }}
            </span>
        </div>

        <form wire:submit.prevent="checkout">
            <button type="submit"
                wire:loading.attr="disabled"
                class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-[1.01] disabled:opacity-70">
                <div wire:loading.remove class="flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Bayar Sekarang</span>
                </div>
                <div wire:loading class="flex items-center justify-center space-x-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Processing...</span>
                </div>
            </button>
        </form>
    </section>
</div>