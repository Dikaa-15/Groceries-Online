<div class="container mx-auto py-12 px-6">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Customer Reviews</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($comments as $comment)
        <div 
            class="bg-white shadow-lg p-6 rounded-lg flex flex-col items-center text-center transition duration-500 transform hover:scale-105 hover:shadow-2xl animate-fadeIn">
            
            <!-- Foto Profil -->
            <img src="{{ asset('storage/' . $comment->user->profile) }}"
                alt="User Profile"
                class="w-16 h-16 rounded-full object-cover mb-4 border-4 border-green-500 shadow-md">
            
            <h3 class="text-lg font-semibold text-gray-800">{{ $comment->user->name }}</h3>
            <p class="text-gray-600 mt-2 italic">"{{ $comment->comment }}"</p>

            <!-- Rating -->
            <div class="flex mt-3 text-yellow-400">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $comment->rate ? 'text-yellow-400' : 'text-gray-300' }}">⭐</span>
                @endfor
                <span class="text-gray-600 ml-2">({{ number_format($comment->rate, 1) }})</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
