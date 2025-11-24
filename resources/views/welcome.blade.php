<!-- resources/views/welcome.blade.php -->
<x-guest-layout>
    @section('title', 'Marketplace Katering')

    <div class="bg-white">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Solusi Katering untuk Kantor Anda
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Platform marketplace katering yang menghubungkan kantor dengan penyedia katering terpercaya. Pesan menu berkualitas dengan mudah dan efisien.
                    </p>
                    <div class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Buka Dasbor
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Mulai Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3 border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                Masuk
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg h-96 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🍱</div>
                        <p class="text-gray-600">Katering berkualitas untuk tim Anda</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="bg-gray-50 py-20 border-y border-gray-200">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Fitur Unggulan</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="text-3xl mb-3">🔍</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Cari Mudah</h3>
                        <p class="text-gray-600">Temukan katering berdasarkan lokasi, jenis makanan, dan rating</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="text-3xl mb-3">📋</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Menu Variatif</h3>
                        <p class="text-gray-600">Pilih dari berbagai menu dengan harga dan kualitas terjamin</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="text-3xl mb-3">💳</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Invoice Mudah</h3>
                        <p class="text-gray-600">Invoice otomatis untuk kantor dan katering</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="max-w-7xl mx-auto px-4 py-20">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Cara Kerja</h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Untuk Kantor:</h3>
                    <ol class="space-y-4">
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">1</span>
                            <p class="text-gray-700">Daftar akun kantor Anda</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">2</span>
                            <p class="text-gray-700">Cari katering pilihan</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">3</span>
                            <p class="text-gray-700">Pilih menu dan tanggal pengiriman</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">4</span>
                            <p class="text-gray-700">Lakukan pemesanan dan dapatkan invoice</p>
                        </li>
                    </ol>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Untuk Katering:</h3>
                    <ol class="space-y-4">
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">1</span>
                            <p class="text-gray-700">Daftar sebagai penyedia katering</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">2</span>
                            <p class="text-gray-700">Lengkapi profil perusahaan</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">3</span>
                            <p class="text-gray-700">Tambahkan menu makanan Anda</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">4</span>
                            <p class="text-gray-700">Terima dan kelola pesanan</p>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>