<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DetailProduct extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($category, $name)
    {
        $this->product = Product::where('category', $category)
            ->where('name', $name) // atau 'name' tergantung field-nya
            ->firstOrFail();
    }


    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $existing = Carts::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $this->quantity);
        } else {
            Carts::create([
                'user_id'    => Auth::id(),
                'product_id' => $this->product->id,
                'quantity'   => $this->quantity,
            ]);
        }

        // Emit event
        // $this->dispatch('cart-added');
        return redirect()->route('cart');
    }
    public function directBuy($productId)
    {
        $randomCode = Str::random(8); // ← Random 8 karakter

        // Simpan id produk ke session dengan kode acak
        session()->put("checkout_{$randomCode}", $productId);

        // Redirect ke route checkout dengan kode
        return redirect()->route('checkout', ['directCheckout' => $randomCode]);
    }
    
    public function render()
    {
        return view('livewire.detail-product');
    }
}
