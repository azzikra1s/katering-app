<!-- resources/views/customer/merchant-detail.blade.php -->
@extends('layouts.app')

@section('title', $merchant->company_name . ' - FoodHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-8 text-sm text-slate-600">
        <a href="{{ route('customer.merchants') }}" class="hover:text-slate-900">Merchants</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">{{ $merchant->company_name }}</span>
    </div>

    <!-- Merchant Header -->
    <div class="bg-white rounded-lg border border-slate-200 p-8 mb-12">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-4xl font-bold text-slate-900 mb-2">{{ $merchant->company_name }}</h1>
                @if($merchant->description)
                    <p class="text-lg text-slate-600">{{ $merchant->description }}</p>
                @endif
            </div>
            <div class="text-5xl">🏪</div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 pt-6 border-t border-slate-200">
            @if($merchant->phone_number)
                <div>
                    <p class="text-sm text-slate-600 mb-1">📞 Phone</p>
                    <p class="font-medium text-slate-900">{{ $merchant->phone_number }}</p>
                </div>
            @endif

            @if($merchant->address)
                <div>
                    <p class="text-sm text-slate-600 mb-1">📍 Address</p>
                    <p class="font-medium text-slate-900">{{ $merchant->address }}</p>
                </div>
            @endif

            <div>
                <p class="text-sm text-slate-600 mb-1">🍽️ Menu Items</p>
                <p class="font-medium text-slate-900">{{ $merchant->menus()->count() }} available</p>
            </div>
        </div>
    </div>

    <!-- Menu Grid -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Menu</h2>

        @if($merchant->menus()->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="menuCart()">
                @foreach($merchant->menus as $menu)
                    <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-orange-300 hover:shadow-lg transition-all group">
                        <!-- Menu Image -->
                        <div class="h-40 bg-gradient-to-br from-yellow-100 to-orange-100 overflow-hidden flex items-center justify-center text-5xl group-hover:scale-110 transition-transform duration-300">
                            🍜
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $menu->name }}</h3>
                            
                            @if($menu->description)
                                <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $menu->description }}</p>
                            @endif

                            <div class="mb-6">
                                <p class="text-2xl font-bold text-orange-500">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Quantity Selector -->
                            <div class="flex items-center gap-3 mb-4">
                                <button 
                                    @click="quantity = Math.max(1, quantity - 1)"
                                    class="w-8 h-8 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors flex items-center justify-center"
                                >
                                    −
                                </button>
                                <input 
                                    type="number" 
                                    x-model.number="quantity" 
                                    min="1"
                                    class="w-12 text-center border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                >
                                <button 
                                    @click="quantity++"
                                    class="w-8 h-8 rounded-lg border border-slate-300 hover:bg-slate-100 transition-colors flex items-center justify-center"
                                >
                                    +
                                </button>
                            </div>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('customer.cart.add') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="hidden" name="quantity" x-model="quantity">
                                <button 
                                    type="submit"
                                    class="w-full px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium"
                                >
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
                <div class="text-5xl mb-4">🍽️</div>
                <p class="text-slate-600 text-lg">No menu items available yet</p>
            </div>
        @endif
    </div>

    <!-- Back Button -->
    <div class="mt-12">
        <a href="{{ route('customer.merchants') }}" class="text-orange-500 hover:text-orange-600 font-medium flex items-center gap-2">
            <span>←</span>
            Back to Merchants
        </a>
    </div>
</div>

<script>
    function menuCart() {
        return {
            quantity: 1,
        }
    }
</script>
@endsection