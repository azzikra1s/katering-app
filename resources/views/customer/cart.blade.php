<!-- resources/views/customer/cart.blade.php -->
@extends('layouts.app')

@section('title', 'Cart - FoodHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-slate-900 mb-8">Shopping Cart</h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            @if(count($cart) > 0)
                <div class="space-y-4">
                    @php
                        $groupedByMerchant = [];
                        foreach($cart as $item) {
                            $merchantId = $item['merchant_id'];
                            if (!isset($groupedByMerchant[$merchantId])) {
                                $groupedByMerchant[$merchantId] = [
                                    'merchant_name' => $item['merchant_name'],
                                    'items' => []
                                ];
                            }
                            $groupedByMerchant[$merchantId]['items'][] = $item;
                        }
                    @endphp

                    @foreach($groupedByMerchant as $merchantId => $merchantGroup)
                        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
                            <!-- Merchant Header -->
                            <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-slate-200">
                                <h3 class="font-bold text-slate-900 flex items-center gap-2">
                                    <span>🏪</span>
                                    {{ $merchantGroup['merchant_name'] }}
                                </h3>
                            </div>

                            <!-- Items -->
                            <div class="divide-y divide-slate-200">
                                @foreach($merchantGroup['items'] as $item)
                                    <div class="p-6 flex items-start gap-4 hover:bg-slate-50 transition-colors group">
                                        <div class="text-4xl">🍜</div>
                                        
                                        <div class="flex-1">
                                            <h4 class="font-bold text-slate-900 mb-1">{{ $item['name'] }}</h4>
                                            <p class="text-sm text-slate-600 mb-3">
                                                Rp {{ number_format($item['price'], 0, ',', '.') }} × {{ $item['quantity'] }}
                                            </p>
                                            <p class="text-lg font-bold text-orange-500">
                                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-sm text-slate-600 mb-3">Qty: {{ $item['quantity'] }}</p>
                                            <form action="{{ route('customer.cart.remove', $item['menu_id']) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
                    <div class="text-6xl mb-4">🛒</div>
                    <p class="text-slate-600 text-lg mb-6">Your cart is empty</p>
                    <a href="{{ route('customer.merchants') }}" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- Summary & Checkout -->
        @if(count($cart) > 0)
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-slate-200 p-6 sticky top-24 space-y-6">
                    <h3 class="text-xl font-bold text-slate-900">Order Summary</h3>

                    <div class="space-y-3 border-b border-slate-200 pb-6">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Delivery Fee</span>
                            <span>Rp 15.000</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Tax</span>
                            <span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-900">Total</span>
                        <span class="text-2xl font-bold text-orange-500">
                            Rp {{ number_format($total + 15000 + ($total * 0.1), 0, ',', '.') }}
                        </span>
                    </div>

                    <form action="{{ route('customer.checkout') }}" method="POST" class="space-y-4" x-data="checkout()">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Delivery Address</label>
                            <textarea 
                                name="delivery_address"
                                rows="3"
                                required
                                class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                                placeholder="Enter your delivery address..."
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Delivery Date</label>
                            <input 
                                type="date"
                                name="delivery_date"
                                :min="todayDate"
                                required
                                class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            >
                        </div>

                        <button 
                            type="submit"
                            class="w-full px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-bold text-lg"
                        >
                            Proceed to Checkout
                        </button>
                    </form>

                    <a href="{{ route('customer.merchants') }}" class="block text-center px-6 py-3 border-2 border-slate-300 text-slate-900 rounded-lg hover:border-slate-400 transition-all font-medium">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function checkout() {
        return {
            todayDate: new Date().toISOString().split('T')[0],
        }
    }
</script>
@endsection