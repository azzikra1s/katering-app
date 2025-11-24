<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    @section('title', 'Daftar - Marketplace Katering')

    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-center mb-2">Daftar Akun Baru</h2>
            <p class="text-center text-gray-600 text-sm mb-8">Bergabunglah dengan Marketplace Katering</p>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div x-data="{ role: '{{ old('role', 'kantor') }}' }" class="space-y-4">
                    <div class="text-sm font-medium text-gray-700 mb-3">Daftar sebagai:</div>
                    
                    <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer transition" 
                        :class="role === 'kantor' ? 'border-blue-600 bg-blue-50' : 'border-gray-200'">
                        <input type="radio" name="role" value="kantor" x-model="role" required
                            class="w-4 h-4 text-blue-600">
                        <span class="ml-3">
                            <span class="font-medium text-gray-900">🏢 Kantor</span>
                            <p class="text-gray-600 text-xs">Pesan katering untuk karyawan</p>
                        </span>
                    </label>

                    <label class="flex items-center p-3 border-2 rounded-lg cursor-pointer transition" 
                        :class="role === 'katering' ? 'border-blue-600 bg-blue-50' : 'border-gray-200'">
                        <input type="radio" name="role" value="katering" x-model="role" required
                            class="w-4 h-4 text-blue-600">
                        <span class="ml-3">
                            <span class="font-medium text-gray-900">🍽️ Katering</span>
                            <p class="text-gray-600 text-xs">Jual paket katering Anda</p>
                        </span>
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap / Perusahaan</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="PT. Nama Perusahaan">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="email@perusahaan.com">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Ulangi password">
                </div>

                <div class="flex items-start">
                    <input type="checkbox" name="agree" id="agree" required
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300 mt-1">
                    <label for="agree" class="ml-2 text-sm text-gray-700">
                        Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-700">Syarat & Ketentuan</a>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-6">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">Masuk sekarang</a>
            </p>
        </div>
    </div>
</x-guest-layout>