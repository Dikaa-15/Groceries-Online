<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class CartIcon extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    // protected $listeners = ['cartUpdated' => '$refresh'];


    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {

        if (Auth::check()) {
            $this->cartCount = Carts::where('user_id', Auth::id())->sum('quantity');
        } else {
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
