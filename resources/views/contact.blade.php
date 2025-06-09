<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#16a34a', // green-600
                        }
                    }
                }
            }
        }
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <!-- Load Lucide Icons dan FontAwesome -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <x-navbar class="bg-main"></x-navbar>
    <div class="container mx-auto px-4 py-12 mt-16">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Have questions or feedback? We'd love to hear from you. Reach out through the form below or visit our
                location.
            </p>
        </div>

        <!-- Two Column Layout -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Map -->
            <div class="lg:w-1/2 w-full">
                <div class="bg-white rounded-2xl shadow-md overflow-hidden h-full">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Locasi kami</h2>
                        <p class="text-gray-600 mb-6">
                            SMK Jakarta Pusat 1<br>
                            Jl. Abdul Muis No.44 1, RT.1/RW.8, Petojo Sel., Kecamatan Gambir, Kota Jakarta Pusat, Daerah
                            Khusus Ibukota Jakarta 10160<br>
                            Phone_number: 0213843975
                        </p>
                    </div>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.3322487500934!2d106.81814689189198!3d-6.175649972288092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d525ce8be1%3A0xce3ad79b85371985!2sSMK%20Jakarta%20Pusat%201!5e0!3m2!1sid!2sid!4v1749273976422!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <!-- Right Column - Form -->
            <div class="lg:w-1/2 w-full">
                <div class="bg-white rounded-2xl shadow-md p-8 h-full">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Send us a messages</h2>

                    <!-- Contact Form -->
                    <form class="space-y-6" method="POST" action="{{ route('contact.store') }}">
                        @csrf

                        <!-- Notifikasi sukses -->
                        @if(session('success'))
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Nama Lengkap (Readonly) -->
                        <div class="relative">
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name ?? 'Guest' }}" readonly
                                class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 bg-gray-100 placeholder-transparent focus:outline-none focus:border-primary-600"
                                placeholder=" " />
                            <label for="name"
                                class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-primary-600 peer-focus:text-sm">
                                Nama Lengkap
                            </label>
                        </div>

                        <!-- Email (Readonly) -->
                        <div class="relative">
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email ?? '-' }}" readonly
                                class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 bg-gray-100 placeholder-transparent focus:outline-none focus:border-primary-600"
                                placeholder=" " />
                            <label for="email"
                                class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-primary-600 peer-focus:text-sm">
                                Email
                            </label>
                        </div>

                        <!-- Nomor HP (Readonly) -->
                        <div class="relative">
                            <input type="text" name="phone_number" id="phone_number" value="{{ Auth::user()->phone_number ?? '-' }}" readonly
                                class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 bg-gray-100 placeholder-transparent focus:outline-none focus:border-primary-600"
                                placeholder=" " />
                            <label for="phone_number"
                                class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-primary-600 peer-focus:text-sm">
                                No. HP
                            </label>
                        </div>

                        <!-- Pesan -->
                        <div class="relative">
                            <textarea name="messages" id="messages" rows="4"
                                class="peer h-24 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-primary-600 resize-none"
                                placeholder=" " required>{{ old('messages') }}</textarea>
                            <label for="messages"
                                class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-primary-600 peer-focus:text-sm">
                                Your Messages <span class="text-sm">(Maks 255 karakter)</span>
                            </label>
                            @error('messages')
                            <p class="text-red-500 text-sm mt-1">{{ $messages }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit"
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg shadow-sm transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-opacity-50">
                            Send Messages
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</body>

</html>