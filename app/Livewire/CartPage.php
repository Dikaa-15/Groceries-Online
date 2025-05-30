<?php

namespace App\Livewire;

use App\Models\Carts;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    public $cartItems;
    protected $listeners = ['cartUpdated' => 'loadCart'];
    public $selectedItems = [];
    public $cartId;
    public $selectAll = false;

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = $this->cartItems->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function checkoutSelected()
    {
        if (!empty($this->selectedItems)) {
            session()->put('checkout_cart_ids', $this->selectedItems);
            return redirect()->route('checkout');
        }
    }


    public function getTotalPrice()
    {
        return $this->cartItems
            ->whereIn('id', $this->selectedItems)
            ->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedItems)) {
            Carts::whereIn('id', $this->selectedItems)
                ->where('user_id', Auth::id())
                ->delete();

            $this->selectedItems = [];
            $this->selectAll = false;
            $this->loadCart();
        }
    }

    public function updatedSelectedItems()
    {
        $this->selectAll = count($this->selectedItems) === $this->cartItems->count();
        $this->selectedItems = array_filter($this->selectedItems); // Filter item terpilih
    }

    public function directBuy($productId)
    {
        $randomCode = Str::random(8); // ← Random 8 karakter

        // Simpan id produk ke session dengan kode acak
        session()->put("checkout_{$randomCode}", $productId);

        // Redirect ke route checkout dengan kode
        return redirect()->route('checkout', ['directCheckout' => $randomCode]);
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
