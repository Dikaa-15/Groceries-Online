<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Checkout</h2>

    <table class="w-full mb-4">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Produk</th>
                <th class="text-center py-2">Qty</th>
                <th class="text-right py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr class="border-b">
                <td class="py-2">{{ $item->product->name }}</td>
                <td class="py-2 text-center">{{ $item->quantity }}</td>
                <td class="py-2 text-right">Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-xl font-bold text-right mb-4">Total: Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
        <select wire:model="paymentMethod" class="w-full mt-1 p-2 border rounded">
            <option value="">Pilih Pembayaran</option>
            <option value="bca">BCA</option>
            <option value="bri">BRI</option>
            <option value="bni">BNI</option>
        </select>
        @error('paymentMethod') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <form wire:submit.prevent="checkout" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Upload Bukti Transfer</label>
            <input type="file" wire:model="transfer_poto" class="w-full mt-1 p-2 border rounded">
            @error('transfer_poto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Checkout</button>
        <!-- <button wire:click="checkout" class="bg-green-600 text-white px-4 py-2 rounded-lg">Checkout</button> -->
    </form>



    @if (session()->has('message'))
    <p class="mt-4 text-green-600">{{ session('message') }}</p>
    @endif
</div>