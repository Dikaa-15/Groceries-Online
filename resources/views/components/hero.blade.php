<section class="relative bg-green-50 pt-24 pb-16 min-h-screen flex items-center">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-6">
        <!-- Left Content -->
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800 leading-tight">
                Fresh & Organic Groceries Delivered to Your Doorstep
            </h1>
            <p class="mt-4 text-gray-600 text-base md:text-lg">
                Get the best quality fresh vegetables, fruits, and organic food with fast delivery.
            </p>
            <a href="{{ url('/products') }}" 
               class="mt-6 inline-block bg-green-500 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-green-600 transition">
                Shop Collection →
            </a>
        </div>

        <!-- Right Image -->
        <div class="md:w-1/3 mt-8 md:mt-0">
            <img src="{{ asset('hero/hero-section.png') }}" alt="Groceries" class="w-full max-w-xs md:max-w-lg mx-auto md:mx-0">
        </div>
    </div>
</section>
    