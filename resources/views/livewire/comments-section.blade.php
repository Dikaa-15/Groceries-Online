<div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Section Heading -->
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">Fresh Reviews</h2>
        <p class="text-lg text-gray-600">Hear what our customers say about their shopping experience</p>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($comments as $comment)
        <div
            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 hover:-translate-y-1">
            <div class="p-6">
                <!-- User Info -->
                <div class="flex items-center mb-4">
                    @php
                    $initials = strtoupper(Str::substr($comment->user->name, 0, 1) . Str::substr(Str::after($comment->user->name, ' '), 0, 1));
                    $colorVariants = ['green', 'blue', 'purple', 'yellow', 'red', 'indigo', 'pink', 'orange'];
                    $color = $colorVariants[$loop->index % count($colorVariants)];
                    @endphp
                    <div class="bg-{{ $color }}-100 text-{{ $color }}-800 rounded-full w-12 h-12 flex items-center justify-center font-semibold text-lg">
                        {{ $initials }}
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-800">{{ $comment->user->name }}</h3>
                        <div class="flex items-center mt-1">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $comment->rate ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                            </div>
                            <span class="text-gray-500 text-sm ml-2">{{ number_format($comment->rate, 1) }}</span>
                        </div>
                    </div>
                </div>
                <!-- Comment -->
                <p class="text-gray-600 mb-4 italic">“{{ $comment->comment }}”</p>
                <p class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>