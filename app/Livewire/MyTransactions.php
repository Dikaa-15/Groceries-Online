<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class MyTransactions extends Component
{
    use WithPagination;

    public $statusFilter = null;

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Transaction::with([
            'user',
            'product',
            'review' => function ($query) {
                $query->where('user_id', Auth::id());
            }
        ])->where('user_id', Auth::id());

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $query->orderByRaw("(status = 'success' AND EXISTS (
        SELECT 1 FROM rates
        WHERE rates.product_id = transactions.product_id
        AND rates.user_id = ?
    )) ASC", [Auth::id()]);

        $transactions = $query->latest()->paginate(10);

        return view('livewire.my-transactions', compact('transactions'));
    }
}
