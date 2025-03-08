<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Checkout extends Component
{
    use WithFileUploads;

    public $cartItems;
    public $paymentMethod;
    public $totalPrice;
    public $transfer_poto;
    public $selectedItems = [];

    public function mount($directCheckout = false)
    {
        if ($directCheckout) {
            $productId = session()->get('direct_checkout_product_id');
            if ($productId) {
                $product = Product::findOrFail($productId);

                $this->cartItems = collect([(object) [
                    'id' => null,
                    'product_id' => $product->id,
                    'product' => $product,
                    'quantity' => 1,
                ]]);

                $this->totalPrice = $product->price;
            }
        } else {
            $selectedItems = session()->get('selected_cart_items', []);
            $this->cartItems = Carts::where('user_id', Auth::id())
                ->whereIn('id', $selectedItems)
                ->get();

            $this->totalPrice = $this->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        }
    }

    public function checkout()
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

            if ($item->id) {
                Carts::where('id', $item->id)->delete();
            }
        }

        session()->flash('message', 'Checkout berhasil! Pesanan sedang diproses.');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
