<!-- resources/views/customer/merchants.blade.php -->
<x-app-layout>
    @section('title', 'Cari Katering - Marketplace Katering')

    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Cari Katering</h1>
            <p class="text-gray-600 mt-1">Temukan katering pilihan untuk kebutuhan kantor Anda</p>
        </div>

        <!-- Search -->
        <div x-data="{ search: '', location: '' }" class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Katering</label>
                    <input type="text" x-model="search" placeholder="Ketik nama katering..." 
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <select x-model="location" 
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Lokasi</option>
                        <option value="jakarta">Jakarta</option>
                        <option value="tangsel">Tangerang Selatan</option>
                        <option value="bekasi">Bekasi</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-2">
                        Cari
                    </button>
                </div>
            </div>
        </div>

        <!-- Katering List -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($merchants as $merchant)
                <a href="{{ route('customer.merchants.detail', $merchant) }}" class="bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all overflow-hidden group">
                    <div class="h-40 bg-gray-100 flex items-center justify-center text-4xl group-hover:bg-gray-200 transition-colors">
                        🍽️
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900">{{ $merchant->company_name }}</h3>
                        @if($merchant->description)
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $merchant->description }}</p>
                        @endif
                        <p class="text-sm text-gray-600 mt-3">
                            📍 {{ Str::limit($merchant->address, 40) }}
                        </p>
                        <p class="text-sm text-blue-600 font-medium mt-2">
                            {{ $merchant->menus()->count() }} menu
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600">Tidak ada katering ditemukan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($merchants->hasPages())
            <div class="flex justify-center">
                {{ $merchants->links() }}
            </div>
        @endif
    </div>
</x-app-layout>