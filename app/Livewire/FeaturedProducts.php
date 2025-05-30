<?php

namespace App\Livewire;

use App\Models\Carts;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class FeaturedProducts extends Component
{
    use WithPagination;

    public $selectedCategories = ['sayuran']; // Default kategori
    public $categoryIndex = 0; // Index kategori yang sedang ditampilkan
    protected $paginationTheme = 'tailwind'; // Gunakan Tailwind CSS
    public $productId = [];

    public function updatedSelectedCategories()
    {
        $this->categoryIndex = 0; // Reset ke kategori pertama
        $this->resetPage(); // Reset pagination ke halaman pertama
    }

    public function directBuy($productId)
    {
        $randomCode = Str::random(8); // ← Random 8 karakter

        // Simpan id produk ke session dengan kode acak
        session()->put("checkout_{$randomCode}", $productId);

        // Redirect ke route checkout dengan kode
        return redirect()->route('checkout', ['directCheckout' => $randomCode]);
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

        return Product::withAvg('rates', 'rate') // Dapatkan rata-rata rate
            ->where('category', $category)
            ->paginate(10);
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
