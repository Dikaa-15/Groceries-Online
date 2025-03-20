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

    public $paymentMethod, $transferPhoto;

    public function mount($productId)
    {
        $this->product = Product::find($productId) ?? abort(404, 'Product not found');
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
            return redirect()->route('login');
        }

        // Validasi Input
        $this->validate([
            'paymentMethod' => 'required|in:bca,bri,bni',
            'transferPhoto' => $this->paymentMethod !== 'bca' ? 'nullable' : 'required|image|max:2048',
        ]);


        // Cek stok sebelum checkout
        if ($this->product->stock < $this->quantity) {
            session()->flash('error', 'Stock is not enough!');
            return;
        }



        // Simpan Foto Transfer
        $photoPath = $this->transferPhoto->store('transfers', 'public');

        // Simpan Order
        $order = Transaction::create([
            'order_id' => 'ORD-' . time(),
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => $this->quantity,
            'total_price' => $this->product->price * $this->quantity,
            'status' => 'pending',
            'payment' => $this->paymentMethod,
            'transfer_poto' => $photoPath,
        ]);

        // Kurangi stok produk
        $this->product->decrement('stock', $this->quantity);

        return redirect()->route('/');
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
        return view('livewire.product-detail');
    }
}
