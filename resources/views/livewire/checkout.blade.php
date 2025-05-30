<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <!-- Informasi Pengiriman (Dummy / bisa pakai data user) -->
    <section>
        <h2 class="text-xl font-semibold mb-4">📦 Informasi Pengiriman</h2>
        <div class="border p-4 rounded space-y-2">
            <p class="font-medium">Nama: {{ Auth::user()->name }}</p>
            <p>Alamat: {{ Auth::user()->personalData->address }}</p>
            <p>No. HP: {{ Auth::user()->phone_number }}</p>
        </div>
    </section>
    <!-- Daftar Produk -->
    <section>
        <h2 class="text-xl font-semibold mb-4">🛒 Produk yang Dibeli</h2>
        <div class="space-y-4">
            @foreach ($cartItems as $index => $item)
            <div class="flex items-center justify-between border-b pb-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="Produk" class="w-16 h-16 object-cover rounded">
                    <div>
                        <p class="font-medium">{{ $item->product->name }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <button wire:click.prevent="decrementQuantity({{ $index }})"
                                class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                            <span class="px-3 py-1 border rounded">{{ $item->quantity }}</span>
                            <button wire:click.prevent="incrementQuantity({{ $index }})"
                                class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                        </div>
                    </div>
                </div>
                <p class="text-right font-semibold text-gray-700">
                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>
    </section>


    <!-- Metode Pembayaran -->
    <section>
        <h2 class="text-xl font-semibold mb-4">💳 Metode Pembayaran</h2>
        <select wire:model.defer="paymentMethod" class="w-full border p-2 rounded">
            <option value="">Pilih Pembayaran</option>
            <option value="bca">Transfer Bank (BCA)</option>
            <option value="bri">Transfer Bank (BRI)</option>
            <option value="bni">Transfer Bank (BNI)</option>
        </select>
        @error('paymentMethod')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </section>

    <!-- Upload Bukti Transfer -->
    <section>
        <h2 class="text-xl font-semibold mb-4">📷 Upload Bukti Transfer</h2>
        <input type="file" wire:model="transfer_poto" class="w-full p-2 border rounded">
        @error('transfer_poto')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </section>

    <!-- Ringkasan Pembayaran -->
    <section class="border-t pt-4">
        <div class="flex justify-between text-lg font-medium">
            <span>Total</span>
            <span class="text-green-600">
                Rp{{ number_format($totalPrice, 0, ',', '.') }}
            </span>
        </div>

        <form wire:submit.prevent="checkout">
            <button type="submit"
                wire:loading.attr="disabled"
                class="mt-4 w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg shadow">
                <span wire:loading.remove>Bayar Sekarang</span>
                <span wire:loading>Memproses...</span>
            </button>
        </form>
    </section>
</div>