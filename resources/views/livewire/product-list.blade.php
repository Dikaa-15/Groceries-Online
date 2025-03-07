<div class="container mx-auto py-8 px-6">

    <!-- Live Search -->
    <input type="text" wire:model.live="search"
        placeholder="Cari produk..."
        class="border p-2 rounded w-full mb-4 bg-white bg-opacity-30 backdrop-blur-lg shadow-md text-gray-800">

    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar Kategori -->
        <div class="col-span-3 bg-white bg-opacity-40 backdrop-blur-lg p-6 rounded-2xl shadow-lg">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Categories</h3>

            <div class="space-y-3">
                @foreach (['sayuran', 'buah', 'daging', 'susu', 'telur'] as $cat)
                <label class="flex items-center space-x-3 cursor-pointer hover:bg-green-100 hover:bg-opacity-30 transition px-3 py-2 rounded-lg">
                    <input type="checkbox" wire:model.live="categories" value="{{ $cat }}"
                        class="w-5 h-5 text-green-500 border-gray-300 rounded-md focus:ring-green-400 accent-green-500">
                    <span class="text-gray-800 font-medium">{{ ucfirst($cat) }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="col-span-9">
            <div class="flex justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Products</h2>
                <select wire:model="sortBy" class="border px-3 py-2 rounded-lg bg-white bg-opacity-30 backdrop-blur-lg">
                    <option value="asc">Price: Low to High</option>
                    <option value="desc">Price: High to Low</option>
                </select>
            </div>

            <div class="grid grid-cols-3 gap-6">
                @forelse ($products as $product)
                <div class="border rounded-lg shadow-lg overflow-hidden bg-white bg-opacity-30 backdrop-blur-lg">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-48 object-cover rounded-t-lg">

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-center text-gray-800">{{ $product->name }}</h3>
                        <p class="text-green-500 font-bold text-center text-lg mt-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ url('/products/' . $product->id) }}"
                            class="block text-center bg-green-500 text-white font-medium py-2 mt-4 rounded-md hover:bg-green-600 transition">
                            Shop Now!
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-500 text-lg font-semibold">
                    No products available
                </div>
                @endforelse
            </div>

            <!-- Custom Pagination -->
            <div class="mt-6 flex justify-center space-x-4">
                @if ($products->hasMorePages())
                <button wire:click="nextPage" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                    &gt;
                </button>
                @endif

                @if ($products->currentPage() > 1)
                <button wire:click="previousPage" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                    &lt;
                </button>
                @endif
            </div>

        </div>
    </div>

    <!-- Banner Section -->
    <div class="relative w-full mt-32 bg-green-600 bg-opacity-80 rounded-xl overflow-hidden shadow-lg mb-8">
        <img src="{{ asset('banner/2.jpeg') }}"
            alt="Fresh Groceries"
            class="w-full h-64 object-cover opacity-90">

        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center p-6">
            <h2 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">
                Fresh & Healthy Groceries Delivered to You!
            </h2>
            <p class="text-lg text-white mt-2 drop-shadow-md">
                Get the best quality fresh produce at unbeatable prices.
            </p>
            <a href="{{ url('/products') }}"
                class="mt-4 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold text-lg rounded-lg shadow-md transition">
                Shop Now
            </a>
        </div>
    </div>

    <!-- Footer Section Start -->
    <footer class="pt-10 pb-12 ">
        <div class="w-full px-4">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Footer Left Start -->
                    <div class="w-full md:w-[40%] mb-6 md:mb-0">
                        <h1 class="font-bold text-2xl md:text-3xl mb-3 text-gray-900">PerpusJP1</h1>
                        <p class="font-normal text-slate-500">
                            PerpusJP1 adalah aplikasi perpustakaan online yang beroprasi
                            untuk meminjam buku perpustakaan secara online melalui website
                            agar dapat memudahkan para siswa untuk meminjam buku.
                        </p>
                    </div>
                    <!-- Footer Left End -->

                    <!-- Footer Right Start -->
                    <div class="w-full">
                        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-3">
                            <!-- Content 1 Start -->
                            <div class="w-full mb-6 lg:mb-0">
                                <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900">
                                    Ketegori Buku
                                </h3>
                                <ul class="space-y-2">
                                    <li class="text-sm text-slate-500 font-normal">
                                        Buku Pelajaran
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">
                                        Buku Sumber Pendukung
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">
                                        Buku Literasi
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">Lainnya</li>
                                </ul>
                            </div>
                            <!-- Content 1 End -->

                            <!-- Content 2 Start -->
                            <div class="w-full mb-6 lg:mb-0">
                                <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900">Dukungan</h3>
                                <ul class="space-y-2">
                                    <li class="text-sm text-slate-500 font-normal">FAQ</li>
                                    <li class="text-sm text-slate-500 font-normal">
                                        Rekomendasi Buku
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">Lainnya</li>
                                </ul>
                            </div>
                            <!-- Content 2 End -->

                            <!-- Content 3 Start -->
                            <div class="w-full mb-6 lg:mb-0">
                                <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900">
                                    Tentang Kami
                                </h3>
                                <ul class="space-y-2">
                                    <li class="text-sm text-slate-500 font-normal">
                                        Pinjam Buku
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">
                                        Lihat Semua Buku
                                    </li>
                                    <li class="text-sm text-slate-500 font-normal">Lainnya</li>
                                </ul>
                            </div>
                            <!-- Content 3 End -->

                            <!-- Content 4 Start -->
                            <div class="w-full mb-6 lg:mb-0">
                                <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900">
                                    Sosial Media
                                </h3>
                                <ul class="space-y-2">
                                    <li class="text-sm text-slate-500 font-normal">
                                        <i
                                            class="fa-brands fa-instagram text-lg text-red-500 pe-2"></i>Instagram
                                    </li>
                                </ul>
                            </div>
                            <!-- Content 4 End -->
                        </div>
                    </div>
                    <!-- Footer Right End -->
                </div>

                <!-- Horizontal Start -->
                <div class="w-full border border-slate-300 mt-8"></div>
                <!-- Horizontal End -->

                <!-- Copyright Start -->
                <div class="mt-3">
                    <div
                        class="flex flex-col md:flex-row gap-4 justify-between items-center">
                        <p class="font-normal text-sm text-slate-500">
                            © 2022 PerpusJP1. All rights reserved.
                        </p>
                        <form action="{{ route('logout') }}" method="POST">
                            <button type="submit" class="text-slate-500">Logout</button>
                        </form>
                        <p class="font-normal text-sm text-slate-500">Team PerpusJP1</p>
                    </div>
                </div>
                <!-- Copyright End -->
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</div>