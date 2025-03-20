<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>
    @vite('resources/css/app.css')
    @livewireStyles

    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100">

    <div class="flex">
        {{-- Sidebar Dashboard --}}
        <x-user.sidebar />

        {{-- Konten Dashboard --}}
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>

    @livewireScripts
</body>
</html>
