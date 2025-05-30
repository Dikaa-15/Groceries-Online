<?php

namespace App\Livewire;

use App\Models\Rates;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ProductReview extends Component
{
    public $user_id;
    public $product_id;
    public $rate = 0;
    public $comment = '';
    public $canReview = false;
    public $product; // tambahkan properti ini

    public $reviews;

    protected $rules = [
        'rate' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:5',
    ];

    public function checkReviewPermission()
    {
        $hasBought = Transaction::where('user_id', $this->user_id)
            ->where('product_id', $this->product_id)
            ->where('status', 'success')
            ->exists();

        $hasReviewed = Rates::where('user_id', $this->user_id)
            ->where('product_id', $this->product_id)
            ->exists();

        $this->canReview = $hasBought && !$hasReviewed;
    }


    public function mount($name)
    {
        $this->user_id = Auth::id();

        $this->product = Product::where('name', $name)->firstOrFail();
        $this->product_id = $this->product->id;

        $this->loadRatess();
        $this->checkReviewPermission();
    }


    public function loadRatess()
    {
        $this->reviews = Rates::where('product_id', $this->product_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function setRating($rate)
    {
        $this->rate = $rate;
    }

    public function submitReview()
    {
        $this->validate();

        // Validasi tambahan
        if (!$this->canReview) {
            session()->flash('error', 'Kamu sudah pernah memberikan review untuk produk ini.');
            return;
        }

        Rates::create([
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'rate' => $this->rate,
            'comment' => $this->comment,
        ]);

        $this->reset(['rate', 'comment']);
        $this->loadRatess();
        $this->checkReviewPermission();

        session()->flash('message', 'Thanks for your review!');

        return redirect()->route('my-transactions');
    }



    public function render()
    {
        return view('livewire.product-review');
    }
}
