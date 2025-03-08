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
        public $productIds = [];

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
