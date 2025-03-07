<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class FeaturedProducts extends Component
{
    use WithPagination;

    public $selectedCategories = ['sayuran']; // Default kategori
    public $categoryIndex = 0; // Index kategori yang sedang ditampilkan
    protected $paginationTheme = 'tailwind'; // Gunakan Tailwind CSS
    public $productIds = [];

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
            // Jika stok cukup, tambahkan quantity
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
                $product->decrement('stock'); // Kurangi stok produk
            } else {
                session()->flash('error', 'Jumlah melebihi stok yang tersedia!');
                return;
            }
        } else {
            // Jika belum ada, buat entri baru di tabel carts
            Carts::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);

            // Kurangi stok produk karena produk baru masuk ke cart
            $product->decrement('stock');
        }

        // Emit event agar UI bisa update secara real-time (misalnya di icon carts navbar)
        $this->dispatch('cartUpdated')->to('cart-icon');

        // Flash message ke user
        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }


    public function updatedSelectedCategories()
    {
        $this->categoryIndex = 0; // Reset ke kategori pertama
        $this->resetPage(); // Reset pagination ke halaman pertama
    }

    public function getCurrentCategory()
    {
        return $this->selectedCategories[$this->categoryIndex] ?? null;
    }

    public function nextCategory()
    {
        if ($this->hasNextCategory()) {
            $this->categoryIndex++;
            $this->resetPage();
        }
    }

    public function prevCategory()
    {
        if ($this->hasPrevCategory()) {
            $this->categoryIndex--;
            $this->resetPage();
        }
    }

    public function hasNextCategory()
    {
        return $this->categoryIndex < count($this->selectedCategories) - 1;
    }

    public function hasPrevCategory()
    {
        return $this->categoryIndex > 0;
    }

    public function getProducts()
    {
        $category = $this->getCurrentCategory();
        return Product::where('category', $category)->paginate(3);
    }

    public function render()
    {
        return view('livewire.featured-products', [
            'products' => $this->getProducts(),
            'hasNextCategory' => $this->hasNextCategory(),
            'hasPrevCategory' => $this->hasPrevCategory(),
            'currentCategory' => $this->getCurrentCategory(),
        ]);
    }
}
