<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1; // Default quantity 1

    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
    }

    public function addToCart()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must log in to add items to the cart.');
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Carts::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, update quantity
            $cartItem->increment('quantity', $this->quantity);
        } else {
            // Jika belum, buat baru
            Carts::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity
            ]);
        }

        // Kirim event (kalau ingin update di navbar misalnya)
        $this->dispatch('cartUpdated');

        session()->flash('success', 'Product added to cart!');
    }

    public function checkout()
    {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
