<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Team</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        window.onload = () => lucide.createIcons();
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Load Lucide Icons dan FontAwesome -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Load Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- CDN TAILWIND -->
     
</head>

<body class="bg-gradient-to-b from-green-500 to-white min-h-screen py-10 px-4">
    <x-navbar></x-navbar>

    <h1 class="text-4xl font-bold text-white text-center mb-12">Our Team</h1>

    <!-- Card Atas -->
    <!-- Card Atas -->
    <div class="flex justify-center mb-12">
        <div class="bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-xl p-6 text-center text-gray-800 hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('team/dika.png') }}" alt="Dwi Andika" class="w-32 h-32 mx-auto rounded-full object-cover mb-4">
            <h2 class="text-2xl font-semibold">Dwi Andika</h2>
            <p class="text-gray-300 mb-4">Leader of team</p>
            <div class="flex justify-center gap-4">
                <a href="https://instagram.com" target="_blank" class="text-pink-400 hover:text-pink-600 transition-colors">
                    <i data-lucide="instagram" class="w-6 h-6"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Card Bawah -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-10">
        <!-- Virda -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition-transform duration-300">
            <img src="https://via.placeholder.com/150" alt="Virda" class="w-32 h-32 mx-auto rounded-full object-cover mb-4">
            <h2 class="text-xl font-semibold">Virda</h2>
            <p class="text-gray-600 mb-4">Manajemen team</p>
            <div class="flex justify-center gap-4">
                <a href="https://instagram.com" target="_blank" class="text-pink-500 hover:text-pink-700 transition-colors">
                    <i data-lucide="instagram" class="w-6 h-6"></i>
                </a>
            </div>
        </div>

        <!-- Akbir -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition-transform duration-300">
            <img src="https://via.placeholder.com/150" alt="Akbir" class="w-32 h-32 mx-auto rounded-full object-cover mb-4">
            <h2 class="text-xl font-semibold">Akbir</h2>
            <p class="text-gray-600 mb-4">Manajemen team</p>
            <div class="flex justify-center gap-4">
                <a href="https://instagram.com" target="_blank" class="text-pink-500 hover:text-pink-700 transition-colors">
                    <i data-lucide="instagram" class="w-6 h-6"></i>
                </a>
            </div>
        </div>

        <!-- Ahmad Jabbar Salam -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition-transform duration-300">
            <img src="image/seol.jpg" alt="Ahmad Jabbar Salam" class="w-32 h-32 mx-auto rounded-full object-cover mb-4">
            <h2 class="text-xl font-semibold">Ahmad Jabbar Salam</h2>
            <p class="text-gray-600 mb-4">Frontend Developer</p>
            <div class="flex justify-center gap-4">
                <a href="https://instagram.com" target="_blank" class="text-pink-500 hover:text-pink-700 transition-colors">
                    <i data-lucide="instagram" class="w-6 h-6"></i>
                </a>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

</body>

</html>