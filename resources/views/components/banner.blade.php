<div class="container mx-auto py-12 px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Banner Kiri -->
        <div class="col-span-1 bg-gray-100 p-6 rounded-2xl flex flex-col justify-center items-start relative overflow-hidden shadow-lg">
            <p class="text-green-600 font-semibold z-10">Enjoy up to 25%</p>
            <h2 class="text-3xl font-extrabold text-gray-800 mt-2 z-10">Fresh Vegetables</h2>
            <button class="mt-4 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-all duration-300 shadow-md z-10">
                <a href="/products">Shop Now →</a>
            </button>
            <img src="{{ asset('banner/1.png') }}"
                alt="Fresh Vegetable"
                class="absolute bottom-0 right-0 w-40 md:w-48 lg:w-56 h-auto object-cover opacity-90 drop-shadow-lg" />
        </div>

        <!-- Banner Kanan (Full Width di Desktop) -->
        <div class="col-span-1 md:col-span-2 bg-green-900 p-8 rounded-2xl flex flex-col justify-center items-start text-white relative overflow-hidden shadow-lg">
            <div class="absolute inset-0 bg-black bg-opacity-20 backdrop-blur-md rounded-2xl"></div>
            <p class="text-green-300 font-semibold relative z-10">Enjoy up to 30% off</p>
            <h2 class="text-3xl font-extrabold mt-2 relative z-10">Organic & Fresh Products</h2>
            <button class="mt-4 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-all duration-300 shadow-md relative z-10">
                <a href="/products">Shop Now →</a>
            </button>
            <img src="{{ asset('banner/2.jpeg') }}"
                alt="Organic Fresh Products"
                class="absolute top-0 right-0 w-full h-full object-cover opacity-50 rounded-r-2xl" />
        </div>
    </div>
</div>