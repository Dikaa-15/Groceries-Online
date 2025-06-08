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

    public function mount($directCheckout = null)
    {
        if ($directCheckout && session()->has("checkout_{$directCheckout}")) {
            $productId = session()->pull("checkout_{$directCheckout}");
            $product = Product::findOrFail($productId);
            $this->cartItems = collect([(object) [
                'id' => null,
                'product_id' => $product->id,
                'product' => $product,
                'quantity' => 1,
            ]]);
            $this->calculateTotal();
        } else {
            $selectedItems = session()->get('selected_cart_items', []);
            $this->cartItems = Carts::with('product')
                ->where('user_id', Auth::id())
                ->when($selectedItems, fn($q) => $q->whereIn('id', $selectedItems))
                ->get();
            $this->calculateTotal();
        }
    }

    // Method untuk update total price
    public function calculateTotal()
    {
        $this->totalPrice = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    // Tambah quantity
    public function incrementQuantity($index)
    {
        if (isset($this->cartItems[$index])) {
            $this->cartItems[$index]->quantity++;
            $this->calculateTotal();
        }
    }

    // Kurangi quantity (minimal 1)
    public function decrementQuantity($index)
    {
        if (isset($this->cartItems[$index]) && $this->cartItems[$index]->quantity > 1) {
            $this->cartItems[$index]->quantity--;
            $this->calculateTotal();
        }
    }

    public function checkout()
    {
        $this->validate([
            'paymentMethod' => 'required|in:bca,bri,bni',
            'transfer_poto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $photoPath = $this->transfer_poto->store('transfers', 'public');

        $latestTransaction = null;

        foreach ($this->cartItems as $item) {
            $latestTransaction = Transaction::create([
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

        // 🚨 Set session agar hanya bisa akses halaman success setelah ini
        session()->put('success_transaction_id', $latestTransaction->id);

        session()->flash('message', 'Checkout berhasil! Pesanan sedang diproses.');
        // Redirect ke halaman success
        return redirect()->route('checkout.success');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
