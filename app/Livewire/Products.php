<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'Silakan login terlebih dahulu!');
            return;
        }

        $product = Product::find($productId);
        if (!$product) {
            session()->flash('error', 'Produk tidak ditemukan!');
            return;
        }

        // Cek apakah stok masih tersedia
        if ($product->stock <= 0) {
            session()->flash('error', 'Stok produk habis!');
            return;
        }

        // Cari apakah produk sudah ada di keranjang user
        $cartItem = Carts::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Jika stok cukup, tambahkan quantity
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
                $product->decrement('stock'); // Kurangi stok produk
            } else {
                session()->flash('error', 'Jumlah melebihi stok yang tersedia!');
                return;
            }
        } else {
            // Jika belum ada, buat entri baru di tabel carts
            Carts::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

            // Kurangi stok produk karena produk baru masuk ke cart
            $product->decrement('stock');
        }

        // Emit event agar UI bisa update secara real-time (misalnya di icon carts navbar)
        $this->dispatch('cartUpdated')->to('cart-icon');

        // Flash message ke user
        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }


    public function render()
    {
        $products = Product::latest()->take(8)->get();
        return view('livewire.products', compact('products'));
    }
}
