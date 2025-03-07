<?php

namespace App\Livewire;

use App\Models\Carts;
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

    public function mount()
    {
        $selectedItems = session()->get('selected_cart_items', []);

        $this->cartItems = Carts::where('user_id', Auth::id())
            ->whereIn('id', $selectedItems)
            ->get();

        $this->totalPrice = $this->cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    }


    public function checkout()
    {
        $this->validate([
            'paymentMethod' => 'required|in:bca,bri,bni',
            'transfer_poto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Simpan gambar ke storage
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

            // Hapus hanya item yang di-checkout, bukan semua cart
            Carts::where('id', $item->id)->delete();
        }


        // Hapus cart setelah checkout
        // Hapus hanya item yang dipilih dari cart
        Carts::whereIn('id', $this->selectedItems)->delete();

        session()->flash('message', 'Checkout berhasil! Pesanan sedang diproses.');
        return redirect()->route('/'); // Sesuaikan dengan route yang sesuai
    }

    public function updatedtransfer_poto()
    {
        $this->validate([
            'transfer_poto' => 'required|image|max:2048',
        ]);
    }



    public function render()
    {
        return view('livewire.checkout');
    }
}
