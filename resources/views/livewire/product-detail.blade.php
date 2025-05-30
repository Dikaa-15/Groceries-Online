<div class="container mx-auto max-w-7xl mt-16 py-8 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

        <!-- Product Image Gallery -->
        <div class="lg:col-span-1">
            <div class="rounded-2xl overflow-hidden shadow-xl bg-white border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-auto object-cover aspect-square transition-transform duration-500 hover:scale-105" />
            </div>
            <!-- You could add thumbnail gallery here if you have multiple images -->
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-1 flex flex-col space-y-6">
            @if (session()->has('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-700 font-medium">
                {{ session('success') }}
            </div>
            @endif
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center mb-4">
                    <span class="text-yellow-400 text-xl">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < round($product->averageRating()))
                            ★
                            @else
                            ☆
                            @endif
                            @endfor
                            @if ($product->averageRating() > 0)
                            <span class="text-yellow-400 text-xl">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < round($product->averageRating()))
                                    ★
                                    @else
                                    ☆
                                    @endif
                                    @endfor
                            </span>
                            <span class="text-gray-500 ml-2">
                                ({{ $product->rates->count() }} reviews)
                            </span>
                            @else
                            <span class="text-gray-500 italic text-sm">Belum memiliki rating</span>
                            @endif

                </div>


                <p class="text-emerald-600 text-3xl font-bold mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="prose max-w-none text-gray-700 mb-5">
                    <p class="leading-relaxed">{{ $product->description }}</p>
                </div>
            </div>

            <!-- Quantity Selector -->
            <div class="flex flex-col space-y-2  mt-[-20px]">
                <span class="text-sm font-medium text-gray-700">Quantity</span>
                <div class="flex items-center space-x-3">
                    <button type="button" wire:click="decreaseQuantity"
                        class="bg-gray-100 hover:bg-gray-200 active:bg-gray-300 transition rounded-lg w-10 h-10 flex items-center justify-center font-bold text-xl select-none">
                        −
                    </button>

                    <input type="number" min="1" wire:model.live="quantity" readonly
                        class="w-16 text-center border border-gray-200 rounded-lg py-2 text-lg font-semibold focus:ring-2 focus:ring-emerald-500 focus:border-transparent" />

                    <button type="button" wire:click="increaseQuantity"
                        class="bg-gray-100 hover:bg-gray-200 active:bg-gray-300 transition rounded-lg w-10 h-10 flex items-center justify-center font-bold text-xl select-none">
                        +
                    </button>
                </div>
            </div>


        </div>

        <!-- Order Summary & Checkout -->
        <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Order Summary</h2>

            <div class="space-y-4 mb-6">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="font-medium">Free</span>
                </div>
                <div class="flex justify-between pt-4 border-t border-gray-100">
                    <span class="font-semibold">Total</span>
                    <span class="text-emerald-600 font-bold text-lg">
                        Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}
                    </span>
                </div>
            </div>


            <!-- Payment Method -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Payment Method <span class="text-red-500">*</span></h3>
                <div class="space-y-3">
                    @foreach(['bca', 'bri', 'bni'] as $bank)
                    <label class="flex items-center cursor-pointer rounded-lg border-2 p-3 transition-all
                               hover:border-emerald-400 hover:shadow-sm
                                @if($payment === $bank) border-emerald-500 bg-emerald-50 shadow-sm @else border-gray-200 @endif">
                        <input type="radio" wire:model="payment" value="{{ $bank }}" class="hidden" />
                        <img src="{{ asset('icon/' . $bank . '.png') }}" alt="{{ strtoupper($bank) }}" class="w-12 h-8 mr-3 object-contain" />
                        <span class="text-base font-medium text-gray-900">{{ strtoupper($bank) }}</span>
                    </label>
                    @endforeach
                </div>
                @error('payment')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>


            <!-- Upload Receipt -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Transfer Receipt</h3>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                <span>Upload a file</span>
                                <input type="file" wire:model="transferPhoto" class="sr-only" />
                                <div wire:loading wire:target="transferPhoto" class="text-sm text-blue-500 mt-2">
                                    Uploading image... please wait
                                </div>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </div>
                </div>


                @error('transferPhoto')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <!-- Action Buttons -->
            <div class="flex flex-col space-y-3">
                <form wire:submit.prevent="goToCheckout({{ $product->id }})" enctype="multipart/form-data">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-lg transition flex justify-center items-center shadow-md hover:shadow-lg disabled:opacity-70"
                        @if(!$payment) disabled @endif>
                        <span wire:loading.remove>Checkout Now</span>
                        <span wire:loading class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </form>


                <button wire:click="addToCart"
                    class="w-full bg-white hover:bg-gray-50 text-gray-800 font-semibold py-3 px-4 rounded-lg transition border border-gray-300 shadow-sm hover:shadow-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>