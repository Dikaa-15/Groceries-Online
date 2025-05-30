<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


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

<body class="font-sans antialiased bg-gray-50 dark:text-white/50">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <x-hero></x-hero>

    <!-- Kategori Produk -->
    <x-category-section></x-category-section>

    <livewire:featured-products />

    <!-- Banner Promosi -->
    <x-banner></x-banner>

    <!-- Livewire: Komentar -->
    <livewire:comments-section />

    <!-- Livewire: Semua Produk -->
    <livewire:products />

    <!-- Footer -->
    <x-footer></x-footer>

    @livewireScripts
</body>

</html>