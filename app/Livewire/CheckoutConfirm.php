<?php

// app/Http/Livewire/CheckoutConfirm.php
namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class CheckoutConfirm extends Component
{
    use WithFileUploads;

    public $cartItems;
    public $paymentMethod;
    public $transfer_poto;
    public $totalPrice;

    public function mount()
    {
        $selectedItems = session()->get('selected_cart_items', []);

        $this->cartItems = Carts::where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->get();

        $this->totalPrice = $this->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function confirmCheckout()
    {
        $this->validate([
            'paymentMethod' => 'required|in:bca,bri,bni',
            'transfer_poto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $photoPath = $this->transfer_poto->store('transfers', 'public');

        foreach ($this->cartItems as $item) {
            Transaction::create([
                'user_id' => Auth::id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->product->price * $item->quantity,
                'status' => 'pending',
                'payment' => $this->paymentMethod,
                'transfer_poto' => $photoPath,
            ]);

            Carts::where('id', $item->id)->delete();
        }

        session()->forget('selected_cart_items');
        session()->flash('message', 'Checkout berhasil! Pesanan sedang diproses.');

        return redirect()->route('/');
    }

    public function render()
    {
        return view('livewire.checkout-confirm');
    }
}
