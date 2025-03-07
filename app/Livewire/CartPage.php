<?php

namespace App\Livewire;

use App\Models\Carts;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    public $cartItems = [];
    protected $listeners = ['cartUpdated' => 'loadCart'];
    public $selectedItems = [];
    public $cartId;

    public function updatedSelectedItems()
    {
        $this->selectedItems = array_filter($this->selectedItems); // Filter item terpilih
    }

    public function goToCheckout()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'Pilih produk terlebih dahulu sebelum checkout.');
            return;
        }

        session()->put('selected_cart_items', $this->selectedItems);
        return redirect()->route('checkout');
    }


    public function mount()
    {
        $this->loadCart();
    }
    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = Carts::where('user_id', Auth::id())->with('product')->get();
        }
    }
    public function updateQuantity($cartId, $quantity)
    {
        $cart = Carts::find($cartId);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->update(['quantity' => $quantity]);
            $this->dispatch('cartUpdated');
        }
    }
    public function removeItem($cartId)
    {
        $cart = Carts::find($cartId);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
            $this->dispatch('cartUpdated');
            $this->loadCart();
        }
    }
    
    public function increase($cartId)
    {
        $cart = Carts::findOrFail($cartId);
        $cart->quantity++;
        $cart->save();
        $this->dispatch('cartUpdated');
    }

    public function decrease($cartId)
    {
        $cart = Carts::findOrFail($cartId);
        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
            $this->dispatch('cartUpdated');
        }
    }


    public function checkout()
    {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
