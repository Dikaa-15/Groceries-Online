<?php

namespace App\Livewire;

use App\Models\Rates;
use Livewire\Component;

class CommentsSection extends Component
{
    public $comments;

    public function mount()
    {
        $this->comments = Rates::with('user')->latest()->take(6)->get();
    }
    
    public function render()
    {
        return view('livewire.comments-section');
    }
}
