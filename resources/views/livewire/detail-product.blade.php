<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-50 to-white min-h-screen font-sans">
    
    @if (session()->has('success'))
    <div id="cart-alert" class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
        {{ session('success') }}
    </div>
    @endif

    @push('scripts')
    <script>
        window.addEventListener('cart-added', () => {
            const alertBox = document.getElementById('cart-alert');
            if (alertBox) {
                alertBox.style.display = 'block';
                alertBox.innerText = 'Produk berhasil ditambahkan ke keranjang!';

                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }
        });
    </script>
    @endpush

    <div class="max-w-7xl mx-auto mt-10 p-6">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col lg:flex-row gap-8 border border-gray-200">

            <!-- Gambar Produk -->
            <div class="lg:w-1/2 flex flex-col gap-4">
                <div class="overflow-hidden rounded-lg border hover:shadow-xl transition">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        width="100" class="w-full h-[400px] object-cover" />
                </div>

                <!-- Thumbnail dummy -->
                <div class="flex gap-3 mt-2">
                    @for ($i = 1; $i
                    <= 3; $i++)
                        <img src="{{ asset('storage/' . $product->image) }}"
                        class="w-20 h-20 object-cover border rounded-lg cursor-pointer hover:scale-105 transition" />
                    @endfor
                </div>
            </div>

            <!-- Info Produk -->
            <div class="lg:w-1/2 flex flex-col gap-4">
                <!-- Nama & Kategori -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <span class="inline-block mt-2 px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full font-semibold">
                        {{ $product->category }}
                    </span>
                </div>

                <!-- Harga -->
                <div class="text-4xl font-bold text-emerald-600 mt-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>

                <!-- Stok dan Ukuran -->
                <div class="flex items-center gap-10 mt-4">
                    <div>
                        <p class="text-gray-500 font-medium">Stok</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $product->stock }} pcs</p>
                    </div>
                    <div>
                        <p class="text-gray-500 font-medium">Ukuran</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $product->size }}</p>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Tombol -->
                <div class="flex flex-wrap gap-4 mt-8">
                    <button wire:click="addToCart"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg shadow transition">
                        🛒 Add-to-cart
                    </button>

                    <button
                        class="border border-emerald-600 text-emerald-600 px-6 py-3 rounded-lg hover:bg-emerald-50 transition"
                        wire:click="directBuy({{ $product->id }})">
                        💸 Buy now
                    </button>

                </div>
            </div>
        </div>
    </div>
</body>

</html>