<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Transaction;

class MyTransactions extends Component
{
    use WithPagination;

    public $statusFilter = '';

    // Reset ke halaman 1 setiap kali filter berubah
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Transaction::with(['product', 'review'])
            ->where('user_id', Auth::id());

        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        $transactions = $query->latest()->paginate(10);

        return view('livewire.my-transactions', [
            'transactions' => $transactions,
        ]);
    }
}
