<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Checkout</h2>

    <ul>
        @foreach ($cartItems as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }} = Rp{{ number_format($item->product->price * $item->quantity) }}</li>
        @endforeach
    </ul>

    <p class="mt-4 font-bold">Total: Rp{{ number_format($totalPrice) }}</p>

    <form wire:submit.prevent="confirmCheckout" class="mt-4">
        <label for="paymentMethod">Pilih Metode Pembayaran:</label>
        <select wire:model="paymentMethod" id="paymentMethod" class="block w-full mt-1">
            <option value="">-- Pilih --</option>
            <option value="bca">BCA</option>
            <option value="bri">BRI</option>
            <option value="bni">BNI</option>
        </select>

        <label class="block mt-4">Upload Bukti Transfer:</label>
        <input type="file" wire:model="transfer_poto" class="mt-1">

        <button class="bg-green-500 text-white px-4 py-2 rounded mt-4">Konfirmasi Checkout</button>
    </form>

    @if (session()->has('message'))
        <p class="mt-4 text-green-500">{{ session('message') }}</p>
    @endif
</div>
