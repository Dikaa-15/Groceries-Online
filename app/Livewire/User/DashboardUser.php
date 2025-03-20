<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Transaction;

class DashboardUser extends Component
{
    public $totalTransactions;
    public $totalSpent;
    public $latestTransactions;

    public function mount()
    {
        $userId = auth()->id();

        // Ambil statistik transaksi user
        $this->totalTransactions = Transaction::where('user_id', $userId)->count();
        $this->totalSpent = Transaction::where('user_id', $userId)->sum('total_price');

        // Ambil 5 transaksi terbaru
        $this->latestTransactions = Transaction::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.user.dashboard-user')
        ->layout('layouts.dashboard-user');
    }
}
