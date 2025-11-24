<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Marketplace Katering' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">

        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-blue-600">
                        🍱 Marketplace Katering
                    </a>

                    <div class="hidden md:flex items-center gap-8">
                        @auth
                            @if(auth()->user()->role === 'kantor')
                                <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                                <a href="{{ route('customer.merchants') }}" class="text-gray-700 hover:text-blue-600">Cari Katering</a>
                                <a href="{{ route('customer.orders') }}" class="text-gray-700 hover:text-blue-600">Pesanan</a>
                            @else
                                <a href="{{ route('merchant.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dasbor</a>
                                <a href="{{ route('merchant.menus.index') }}" class="text-gray-700 hover:text-blue-600">Menu</a>
                                <a href="{{ route('merchant.orders') }}" class="text-gray-700 hover:text-blue-600">Pesanan</a>
                            @endif
                        @endauth
                    </div>

                    <div class="flex items-center gap-4">
                        @auth
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" @click.outside="open = false"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">
                                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <div x-show="open" x-transition
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200">
                                    <a href="{{ route('profile.edit') }}"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>

                                    <form method="POST" action="{{ route('logout') }}" class="border-t">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Masuk</a>
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if ($errors->any())
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="rounded-lg bg-red-50 border border-red-200 p-4">
                    <div class="text-sm text-red-800">
                        @foreach ($errors->all() as $error)
                            <div>• {{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 py-4"
                 x-data="{ show: true }" x-show="show" x-transition>
                <div class="rounded-lg bg-green-50 border border-green-200 p-4 flex justify-between">
                    <p class="text-sm text-green-800 font-medium">{{ session('success') }}</p>
                    <button @click="show = false" class="text-green-600 hover:text-green-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1 max-w-7xl mx-auto px-4 py-8">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 mt-20">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <p class="font-bold text-white mb-2">Marketplace Katering</p>
                        <p class="text-sm">Platform katering terpercaya untuk kantor Anda</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4 text-sm">Untuk Kantor</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white">Cari Katering</a></li>
                            <li><a href="#" class="hover:text-white">Pesanan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4 text-sm">Untuk Katering</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white">Bergabung</a></li>
                            <li><a href="#" class="hover:text-white">Bantuan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4 text-sm">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-white">Privasi</a></li>
                            <li><a href="#" class="hover:text-white">Syarat</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center text-sm">
                    <p>&copy; 2024 Marketplace Katering. JASAMEDIKA TRANSMEDIC PT</p>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
