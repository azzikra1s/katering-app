<x-app-layout>
    @section('title', 'Tambah Menu - Marketplace Katering')

    <div class="max-w-2xl space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Menu Baru</h1>

        <form action="{{ route('merchant.menus.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-8 space-y-6">
            @csrf

            <!-- Foto Menu -->
            <div x-data="{ fileName: '', preview: '' }" class="pb-6 border-b border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Menu</label>
                <div class="flex gap-6 items-start">
                    <div class="w-24 h-24 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 text-3xl"
                        x-text="preview ? '✓' : '📸'"></div>
                    <div class="flex-1">
                        <label class="relative cursor-pointer">
                            <div class="px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-blue-600 transition">
                                <input type="file" name="photo" accept="image/*" class="hidden" 
                                    @change="fileName = $el.files[0]?.name; preview = URL.createObjectURL($el.files[0])">
                                <p class="text-sm text-gray-600" x-text="fileName ? fileName : 'Klik untuk upload'"></p>
                            </div>
                        </label>
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG, GIF (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- Nama Menu -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="Contoh: Nasi Goreng Spesial">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Menu</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Jelaskan bahan-bahan dan keunggulan menu ini">{{ old('description') }}</textarea>
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga per Porsi *</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-600 font-medium">Rp</span>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" step="1000"
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                        placeholder="50000">
                </div>
                @error('price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-2">
                    Simpan Menu
                </button>
                <a href="{{ route('merchant.menus.index') }}" class="flex-1 text-center border border-gray-300 text-gray-900 rounded-lg font-medium hover:bg-gray-50 transition-colors py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>