<div class="container mx-auto px-6 py-10">
    <h2 class="text-4xl font-bold text-gray-800 text-center mb-10">Shop by Category</h2>

    <!-- Wrapper Scroll (Hanya aktif di Mobile) -->
    <div class="flex md:grid md:grid-cols-3 lg:grid-cols-5 gap-6 overflow-x-auto md:overflow-visible pb-4 md:pb-0 no-scrollbar">
        @foreach ([ 
            ['name' => 'Sayuran', 'icon' => '🥦'],
            ['name' => 'Buah', 'icon' => '🍎'],
            ['name' => 'Daging', 'icon' => '🥩'],
            ['name' => 'Susu', 'icon' => '🥛'],
            ['name' => 'Telur', 'icon' => '🥚']
        ] as $category)
            <a href="{{ url('/products') }}" class="block">
                <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center min-w-[120px] sm:min-w-[160px] md:min-w-0
                            md:hover:shadow-xl md:transition-transform md:transform md:hover:scale-105 cursor-pointer border border-gray-200">
                    <span class="text-5xl">{{ $category['icon'] }}</span>
                    <p class="mt-3 text-lg font-semibold text-gray-800">{{ $category['name'] }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
