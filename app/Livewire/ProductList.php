<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';


    public array $categories = [];
    public $sortBy = 'asc';
    public $search = '';

    // public function filterByCategory($category)
    // {
    //     $this->category = $category;
    //     $this->resetPage(); // Reset pagination setelah filter kategori
    // }

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination saat search berubah
    }

    public function updatedCategories()
    {
        $this->resetPage(); // Reset pagination biar data reload dengan benar}\
        
    }



    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when(!empty($this->categories), function ($query) {
                return $query->whereIn('category', $this->categories);
            })
            



            ->orderBy('price', $this->sortBy)
            ->paginate(9);

        // dd($this->categories);


        return view('livewire.product-list', compact('products'));
    }
}
