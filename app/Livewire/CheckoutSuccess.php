<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class CheckoutSuccess extends Component
{
    public $transaction;

    public function mount()
    {
        $transactionId = session()->pull('success_transaction_id'); // HAPUS setelah dibaca
        if (!$transactionId) {
            return redirect()->route('home'); // Jika tidak ada session, tendang balik
        }

        $this->transaction = Transaction::findOrFail($transactionId);
    }

    public function render()
    {
        return view('livewire.checkout-success');
    }
}
