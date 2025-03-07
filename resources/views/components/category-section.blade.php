<div class="container mx-auto px-6 py-16">
    <h2 class="text-4xl font-bold text-gray-800 text-center mb-10">Shop by Category</h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
        @foreach ([ 
            ['name' => 'Sayuran', 'icon' => '🥦'],
            ['name' => 'Buah', 'icon' => '🍎'],
            ['name' => 'Daging', 'icon' => '🥩'],
            ['name' => 'Susu', 'icon' => '🥛'],
            ['name' => 'Telur', 'icon' => '🥚']
        ] as $category)
            <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center 
                        hover:shadow-xl transition-transform transform hover:scale-105 cursor-pointer border border-gray-200">
                <span class="text-5xl">{{ $category['icon'] }}</span>
                <p class="mt-3 text-lg font-semibold text-gray-800">{{ $category['name'] }}</p>
            </div>
        @endforeach
    </div>
</div>
