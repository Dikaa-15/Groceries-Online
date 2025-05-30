<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';


    public array $categories = [];
    public $sortBy = 'asc';
    public $search = '';
    public $productId = [];

    // public function filterByCategory($category)
    // {
    //     $this->category = $category;
    //     $this->resetPage(); // Reset pagination setelah filter kategori
    // }



    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'Silakan login terlebih dahulu!');
            return;
        }

        $product = Product::find($productId);
        if (!$product) {
            session()->flash('error', 'Produk tidak ditemukan!');
            return;
        }

        // Cek apakah stok masih tersedia
        if ($product->stock <= 0) {
            session()->flash('error', 'Stok produk habis!');
            return;
        }

        // Cari apakah produk sudah ada di keranjang user
        $cartItem = Carts::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
                $product->decrement('stock'); // Kurangi stok produk
            } else {
                session()->flash('error', 'Jumlah melebihi stok yang tersedia!');
                return;
            }
        } else {
            Carts::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            // Kurangi stok produk karena produk baru masuk ke cart
            $product->decrement('stock');
        }

        $this->dispatch('cartUpdated')->to('cart-icon');

        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }

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
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->categories)) {
            $query->whereIn('category', $this->categories);
        }

        // Default sorting: latest (created_at DESC)
        if (!$this->search && empty($this->categories) && !$this->sortBy) {
            $query->latest(); // = orderBy('created_at', 'desc')
        }
        // Kalau sortBy ada (user udah klik sort), pakai itu
        elseif ($this->sortBy) {
            $query->orderBy('price', $this->sortBy);
        }

        $products = $query->paginate(9);

        return view('livewire.product-list', compact('products'));
    }
}
