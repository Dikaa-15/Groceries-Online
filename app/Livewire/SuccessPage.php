<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class SuccessPage extends Component
{
    public $transaction;

    public function mount($order_id)
    {
        $this->transaction = Transaction::where('order_id', $order_id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.success-page');
    }
}
