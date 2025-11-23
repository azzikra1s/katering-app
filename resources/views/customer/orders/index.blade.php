<!-- resources/views/customer/orders/index.blade.php -->
@extends('layouts.app')

@section('title', 'My Orders - FoodHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">My Orders</h1>
        <p class="text-lg text-slate-600">Track and manage your orders</p>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-md transition-all p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-slate-900">{{ $order->merchant->company_name }}</h3>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ 
                                    $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                                }}">
                                    {{ ucfirst($order->invoice->status) }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-slate-600 mb-1">Order Date</p>
                            <p class="font-medium text-slate-900">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-4 gap-4 mb-4 p-4 bg-slate-50 rounded-lg">
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Items</p>
                            <p class="font-bold text-slate-900">{{ $order->orderItems()->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Delivery</p>
                            <p class="font-bold text-slate-900">{{ $order->delivery_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Location</p>
                            <p class="font-bold text-slate-900 truncate">{{ Str::limit($order->delivery_address, 20) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-600 mb-1">Total</p>
                            <p class="text-lg font-bold text-orange-500">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('customer.orders.detail', $order) }}" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium text-sm">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <p class="text-slate-600 text-lg mb-6">No orders yet</p>
            <a href="{{ route('customer.merchants') }}" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium">
                Start Ordering Now
            </a>
        </div>
    @endif
</div>
@endsection