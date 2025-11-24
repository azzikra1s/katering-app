<!-- resources/views/merchant/profile.blade.php -->
<x-app-layout>
    @section('title', 'Profil Katering - Marketplace Katering')

    <div class="max-w-2xl space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">Profil Katering</h1>

        <form action="{{ route('merchant.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-8 space-y-6">
            @csrf

            <!-- Logo/Foto Profil -->
            <div x-data="{ fileName: '' }" class="pb-6 border-b border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil Perusahaan</label>
                <div class="flex gap-6 items-start">
                    <div class="w-24 h-24 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-3xl">🍽️</span>
                    </div>
                    <div class="flex-1">
                        <label class="relative cursor-pointer">
                            <div class="px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-blue-600 transition">
                                <input type="file" name="photo" accept="image/*" class="hidden" @change="fileName = $el.files[0]?.name">
                                <p class="text-sm text-gray-600" x-text="fileName ? fileName : 'Klik untuk upload'"></p>
                            </div>
                        </label>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG, GIF (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- Nama Perusahaan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan *</label>
                <input type="text" name="company_name" value="{{ old('company_name', $merchant->company_name ?? '') }}" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror"
                    placeholder="PT. Nama Perusahaan Katering">
                @error('company_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Telepon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="tel" name="phone_number" value="{{ old('phone_number', $merchant->phone_number ?? '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="08123456789">
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="address" rows="4"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Jl. Alamat Lengkap, Kelurahan, Kecamatan, Kota, Provinsi">{{ old('address', $merchant->address ?? '') }}</textarea>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Perusahaan</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ceritakan tentang katering Anda, spesialisasi, dan keunggulan">{{ old('description', $merchant->description ?? '') }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-2">
                    Simpan Profil
                </button>
                <a href="{{ route('merchant.dashboard') }}" class="flex-1 text-center border border-gray-300 text-gray-900 rounded-lg font-medium hover:bg-gray-50 transition-colors py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>