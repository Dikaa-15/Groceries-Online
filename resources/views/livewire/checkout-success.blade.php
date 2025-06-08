<div class="max-w-md mx-auto mt-10 w-full bg-white rounded-2xl shadow-soft overflow-hidden">
    <div class="p-6 md:p-8 text-center">
        <!-- Illustration -->
        <div class="relative mb-6">
            <div class="w-48 h-48 mx-auto bg-green-50 rounded-full flex items-center justify-center">
                <div class="relative">
                    <div class="w-32 h-40 bg-green-100 rounded-lg rounded-b-3xl flex items-end justify-center pb-2">
                        <div class="w-28 h-32 bg-green-200 rounded-lg rounded-b-2xl flex flex-col items-center pt-4">
                            <div class="w-6 h-6 bg-yellow-300 rounded-full mb-1"></div>
                            <div class="w-5 h-5 bg-red-400 rounded-full mb-1 ml-8"></div>
                            <div class="w-7 h-4 bg-green-500 rounded-full mb-1 mr-8"></div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white animate-bounce-soft">
                        <i class="fas fa-check text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Headline -->
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Purchase Successful!</h1>
        <p class="text-gray-600 mb-6 max-w-xs mx-auto">
            Your order has been confirmed. Check your order history for details.
        </p>

        <!-- Order Details Card -->
        <div class="bg-green-50 rounded-lg p-4 mb-6 text-left border border-green-100">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Order Number</span>
                <span class="font-medium">#{{ $transaction->order_id }}</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Total Amount</span>
                <span class="font-bold text-green-600">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('my-transactions') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 flex-1 text-center">
                View My Orders
            </a>
            <a href="{{ route('home') }}" class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-200 shadow-sm transition-colors duration-200 flex-1 text-center">
                Back to Shop
            </a>
        </div>
    </div>

    <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-100">
        <p class="text-sm text-gray-500">
            Need help? <a href="#" class="text-green-600 font-medium hover:underline">Contact support</a>
        </p>
    </div>
</div>