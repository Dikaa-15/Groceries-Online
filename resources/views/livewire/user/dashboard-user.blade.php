@extends('layouts.dashboard-user')

@section('title', 'Dashboard User')

@section('content')
<div class="p-6"> {{-- Root Livewire --}}

    {{-- Statistik Transaksi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Total Transactions</h2>
            <p class="text-4xl font-bold">{{ $totalTransactions }}</p>
        </div>
        <div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Total Spent</h2>
            <p class="text-4xl font-bold">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Latest Transactions</h2>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr class="text-left">
                        <th class="border p-3">Image</th>
                        <th class="border p-3">Product</th>
                        <th class="border p-3">Price</th>
                        <th class="border p-3">Qty</th>
                        <th class="border p-3">Total Price</th>
                        <th class="border p-3">Status</th>
                        <th class="border p-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($latestTransactions as $transaction)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            {{-- Kolom Gambar Produk --}}
                            <td class="border p-3">
                                <img src="{{ asset('storage/' . $transaction->product->image) }}" 
                                     alt="{{ $transaction->product->name }}" 
                                     class="w-16 h-16 rounded-md object-cover">
                            </td>
                            
                            {{-- Kolom Nama Produk --}}
                            <td class="border p-3">{{ $transaction->product->name }}</td>

                            {{-- Kolom Harga --}}
                            <td class="border p-3">Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>

                            {{-- Kolom Kuantitas --}}
                            <td class="border p-3 text-center">{{ $transaction->quantity }}</td>

                            {{-- Kolom Total Harga --}}
                            <td class="border p-3">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>

                            {{-- Kolom Status --}}
                            <td class="border p-3">
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                                    @if($transaction->status == 'Pending') bg-yellow-200 text-yellow-800
                                    @elseif($transaction->status == 'Success') bg-green-200 text-green-800
                                    @elseif($transaction->status == 'Failed') bg-red-200 text-red-800
                                    @else bg-gray-200 text-gray-800 @endif">
                                    <span class="w-2 h-2 rounded-full mr-2 
                                        @if($transaction->status == 'Pending') bg-yellow-500
                                        @elseif($transaction->status == 'Success') bg-green-500
                                        @elseif($transaction->status == 'Failed') bg-red-500
                                        @else bg-gray-500 @endif">
                                    </span>
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>

                            {{-- Kolom Action --}}
                            <td class="border p-3 text-center">
                                <a href="" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border p-3 text-center text-gray-500">No Transactions Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div> {{-- Akhir Root --}}
@endsection
