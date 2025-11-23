<!-- resources/views/customer/merchants.blade.php -->
@extends('layouts.app')

@section('title', 'Merchants - FoodHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="merchants()">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-4">Browse Merchants</h1>
        <p class="text-lg text-slate-600">Discover amazing restaurants and food vendors</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg border border-slate-200 p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    x-model="search" 
                    placeholder="Search merchants..." 
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
            </div>
            <div class="w-full md:w-48">
                <select 
                    x-model="sort" 
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
                    <option value="">Sort by</option>
                    <option value="name-asc">Name (A-Z)</option>
                    <option value="name-desc">Name (Z-A)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Merchants Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($merchants as $merchant)
            <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-orange-300 hover:shadow-lg transition-all group">
                <!-- Merchant Image -->
                <div class="h-48 bg-gradient-to-br from-orange-100 to-red-100 overflow-hidden relative">
                    <div class="w-full h-full flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-300">
                        🏪
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $merchant->company_name }}</h3>
                    
                    @if($merchant->description)
                        <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $merchant->description }}</p>
                    @endif

                    <div class="space-y-3 mb-6 text-sm text-slate-600">
                        @if($merchant->phone_number)
                            <p class="flex items-center gap-2">
                                <span>📞</span>
                                {{ $merchant->phone_number }}
                            </p>
                        @endif
                        
                        @if($merchant->address)
                            <p class="flex items-center gap-2">
                                <span>📍</span>
                                {{ Str::limit($merchant->address, 50) }}
                            </p>
                        @endif

                        <p class="flex items-center gap-2">
                            <span>🍽️</span>
                            {{ $merchant->menus()->count() }} menu items
                        </p>
                    </div>

                    <a 
                        href="{{ route('customer.merchants.detail', $merchant) }}" 
                        class="w-full block text-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium"
                    >
                        View Menu
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg border border-slate-200 p-12 text-center">
                <div class="text-5xl mb-4">🏪</div>
                <p class="text-slate-600 text-lg mb-4">No merchants found</p>
                <p class="text-slate-500">Try adjusting your search criteria</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($merchants->hasPages())
        <div class="mt-8">
            {{ $merchants->links() }}
        </div>
    @endif
</div>

<script>
    function merchants() {
        return {
            search: '',
            sort: '',
        }
    }
</script>
@endsection