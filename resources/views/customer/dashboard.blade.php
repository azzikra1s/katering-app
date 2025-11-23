<!-- resources/views/customer/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - FoodHub')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-lg text-slate-600">Browse your favorite merchants and order delicious food</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Orders</p>
                    <p class="text-3xl font-bold text-slate-900">{{ auth()->user()->orders()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-xl">
                    📦
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Spent</p>
                    <p class="text-3xl font-bold text-slate-900">
                        Rp {{ number_format(auth()->user()->orders()->sum('total'), 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-xl">
                    💳
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Pending Orders</p>
                    <p class="text-3xl font-bold text-slate-900">
                        {{ auth()->user()->orders()->where('status', '!=', 'completed')->count() }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-xl">
                    ⏳
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Quick Actions</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <a href="{{ route('customer.merchants') }}" class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-lg transition-all p-8 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-4xl group-hover:scale-110 transition-transform">🏪</div>
                    <svg class="w-5 h-5 text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Browse Merchants</h3>
                <p class="text-slate-600">Explore available restaurants and food merchants</p>
            </a>

            <a href="{{ route('customer.cart') }}" class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-lg transition-all p-8 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-4xl group-hover:scale-110 transition-transform">🛒</div>
                    <svg class="w-5 h-5 text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">View Cart</h3>
                <p class="text-slate-600">Check your cart and proceed to checkout</p>
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Recent Orders</h2>
            <a href="{{ route('customer.orders') }}" class="text-orange-500 hover:text-orange-600 font-medium">View all</a>
        </div>

        @if(auth()->user()->orders()->count() > 0)
            <div class="grid md:grid-cols-2 gap-6">
                @foreach(auth()->user()->orders()->latest()->take(4)->get() as $order)
                    <div class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-md transition-all p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $order->merchant->company_name }}</h3>
                                <p class="text-sm text-slate-600">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ 
                                $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                            }}">
                                {{ ucfirst($order->invoice->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 mb-4">{{ $order->delivery_address }}</p>
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-slate-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            <a href="{{ route('customer.orders.detail', $order) }}" class="text-orange-500 hover:text-orange-600 font-medium text-sm">Details →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
                <div class="text-5xl mb-4">📭</div>
                <p class="text-slate-600 mb-6">No orders yet. Start by browsing our merchants!</p>
                <a href="{{ route('customer.merchants') }}" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all font-medium">
                    Browse Merchants
                </a>
            </div>
        @endif
    </div>
</div>
@endsection