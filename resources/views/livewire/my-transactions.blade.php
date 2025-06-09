<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-green-600">My Transactions</h1>
        <div class="mb-4">
            <select wire:model="statusFilter" class="border rounded px-3 py-2">
                <option value="">-- Semua Status --</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <div class="bg-white shadow-md rounded-md p-6 space-y-6">
            @forelse ($transactions as $transaction)
            <div class="flex items-start space-x-4 border-b pb-4 last:border-none">
                <!-- Product Image -->
                <img src="{{ asset('storage/' . $transaction->product->image) }}"
                    alt="{{ $transaction->product->name }}"
                    class="w-24 h-24 object-cover rounded border">

                <!-- Info -->
                <div class="flex-1">
                    <!-- Atas: Nama Produk, Status, Review sejajar -->
                    <div class="flex justify-between items-center flex-wrap">
                        <h2 class="font-semibold text-gray-800 text-lg">{{ $transaction->product->name }}</h2>

                        <div class="flex items-center space-x-3 mt-2 sm:mt-0">
                            <!-- Status -->
                            <span class="px-2 py-1 text-xs rounded-full
                        @if($transaction->status == 'success') bg-green-100 text-green-800
                        @elseif($transaction->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($transaction->status == 'failed') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>

                            <!-- Review (only if success) -->
                            @if ($transaction->status === 'success')
                            @if ($transaction->review)
                            <div class="flex items-center space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $transaction->review->rate >= $i ? 'fas' : 'far' }} fa-star text-yellow-400 text-sm"></i>
                                    @endfor
                            </div>
                            @else
                            <a href="{{ route('review.product', ['name' => $transaction->product->name]) }}"
                                class="text-sm text-blue-600 hover:underline font-medium">
                                Review Produk
                            </a>
                            @endif
                            @endif
                        </div>
                    </div>

                    <!-- Info Lainnya -->
                    <div class="mt-2 space-y-1">
                        <p class="text-sm text-gray-500">Order #{{ $transaction->order_id }}</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $transaction->quantity }}</p>
                        <p class="text-sm text-gray-500">Harga satuan: Rp{{ number_format($transaction->product->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Harga dan Tanggal -->
                <div class="text-right flex flex-col justify-between items-end min-w-[130px]">
                    <div>
                        <p class="text-gray-600 text-sm">Payment: <span class="font-semibold">{{ $transaction->payment }}</span></p>
                        <p class="font-bold text-green-600 text-lg mt-2">
                            Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                    <p class="text-gray-500 text-xs mt-2">{{ $transaction->created_at->format('d M Y') }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 py-8">Belum ada transaksi nih 😢</p>
            @endforelse

            <div class="mt-6">
                {{ $transactions->links() }}
            </div>

        </div>

    </div>
</x-app-layout>