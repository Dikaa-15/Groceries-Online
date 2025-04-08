<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public $productIds = [];

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
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
                $product->decrement('stock'); // Kurangi stok produk
            } else {
                session()->flash('error', 'Jumlah melebihi stok yang tersedia!');
                return;
            }
        } else {
            Carts::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            // Kurangi stok produk karena produk baru masuk ke cart
            $product->decrement('stock');
        }

        $this->dispatch('cartUpdated')->to('cart-icon');

        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }
    
    public function updatedCategories()
    {
        $this->resetPage(); // Reset pagination biar data reload dengan benar}\

    }


    public function render()
    {
        $products = Product::latest()->take(8)->get();
        return view('livewire.products', compact('products'));
    }
}
