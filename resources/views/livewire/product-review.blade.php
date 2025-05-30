<div class="mt-10">
    <!-- Rating Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <!-- Product Info -->
        <!-- Product Info -->
        <div class="flex items-center mb-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-md">
            <div class="ml-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ $product->category }}</p>
            </div>
        </div>


        <!-- Success Message -->
        @if (session()->has('message'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('message') }}
        </div>
        @endif

        <!-- Rating Form -->
        <form wire:submit.prevent="submitReview">
            <!-- Star Rating -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Your Rating</label>
                <div class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <i
                        wire:click="setRating({{ $i }})"
                        class="{{ $rate >= $i ? 'fas' : 'far' }} fa-star text-3xl cursor-pointer {{ $rate >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition-colors"
                        title="{{ $i }} star"></i>
                        @endfor
                </div>
                @error('rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Comment -->
            <div class="mb-6">
                <label for="comment" class="block text-gray-700 font-medium mb-2">Your Review</label>
                <textarea
                    wire:model.defer="comment"
                    id="comment"
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Share details about your experience with this product..."></textarea>
                @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                Submit Review
            </button>
        </form>
    </div>

    <!-- Recent Reviews Section -->
    <div>
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Reviews</h3>
        <div class="space-y-4">
            @if ($reviews->count() > 0)
            @foreach ($reviews as $review)
            <div class="border border-gray-200 rounded-md p-4">
                <div class="flex items-center mb-2">
                    <!-- Profile Picture -->
                    <img src="{{ $review->user->profile ? asset('storage/' . $review->user->profile) : 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}"
                        alt="{{ $review->user->name }}"
                        class="w-8 h-8 rounded-full object-cover mr-2">

                    <!-- Rating Stars -->
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="{{ $review->rate >= $i ? 'fas' : 'far' }} fa-star text-yellow-400"></i>
                            @endfor
                    </div>

                    <!-- User name -->
                    <span class="ml-2 text-gray-600 text-sm font-medium">
                        {{ $review->user->name }}
                    </span>
                </div>
                <!-- Review Comment -->
                <p class="text-gray-700">{{ $review->comment }}</p>
            </div>
            @endforeach
            @else
            <div class="text-center py-8 text-gray-500" id="noReviews">
                No reviews yet. Be the first to review!
            </div>
            @endif
        </div>
    </div>

</div>