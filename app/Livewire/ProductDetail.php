<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductDetail extends Component
{
    use WithFileUploads;

    public $product;
    public $quantity = 1; // Default quantity 1
    public $payment;
    public $transferPhoto;

    protected $rules = [
        'quantity' => 'integer|min:1',
        'payment' => 'required|in:bca,bri,bni',
        'transferPhoto' => 'required|image|max:2048',
    ];

    // public function updatedPayment($value)
    // {
    //     dd($value); // Check if this fires when selecting a payment method
    // }

    public function mount($productId)
    {
        $this->product = Product::with(['rates.user'])->find($productId) ?? abort(404, 'Product not found');
    }

    public function updatedQuantity()
    {
        if ($this->quantity < 1) {
            $this->quantity = 1; // Minimal quantity adalah 1
        }
    }


    public function addToCart()
    {
        if (!Auth::check()) {
            $this->dispatch('redirectToLogin'); // Tangani di front-end Livewire listener
            return;
        }


        $cartItem = Carts::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $this->quantity);
        } else {
            Carts::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity
            ]);
        }


        $this->dispatch('cartUpdated');
        session()->flash('success', 'Product added to cart!');
    }

    public function goToCheckout($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Kasih redirect ke login dulu kalau belum login
        }

        // Simpan productId ke session
        session()->put('direct_checkout_product_id', $productId);

        // Redirect ke halaman konfirmasi checkout
        return redirect()->route('checkout.confirm');
    }

    public function increaseQuantity()
    {
        $this->quantity++;
    }
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) $this->quantity--;
    }


    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product
        ]);
    }
}
