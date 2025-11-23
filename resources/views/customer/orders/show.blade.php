<!-- resources/views/customer/orders/show.blade.php -->
@extends('layouts.app')

@section('title', 'Order Detail - FoodHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-8 text-sm text-slate-600">
        <a href="{{ route('customer.orders') }}" class="hover:text-slate-900">My Orders</a>
        <span>/</span>
        <span class="text-slate-900 font-medium">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="md:col-span-2 space-y-6">
            <!-- Order Header -->
            <div class="bg-white rounded-lg border border-slate-200 p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $order->merchant->company_name }}</h1>
                        <p class="text-slate-600">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ 
                        $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                    }}">
                        {{ ucfirst($order->invoice->status) }}
                    </span>
                </div>

                <div class="grid md:grid-cols-3 gap-4 pt-6 border-t border-slate-200">
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Order Date</p>
                        <p class="font-bold text-slate-900">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Delivery Date</p>
                        <p class="font-bold text-slate-900">{{ $order->delivery_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Invoice Number</p>
                        <p class="font-bold text-slate-900">{{ $order->invoice->invoice_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg border border-slate-200 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Order Items</h2>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-start justify-between p-4 bg-slate-50 rounded-lg">
                            <div class="flex items-start gap-4">
                                <div class="text-3xl">🍜</div>
                                <div>
                                    <h3 class="font-bold text-slate-900">{{ $item->menu->name }}</h3>
                                    <p class="text-sm text-slate-600">
                                        Rp {{ number_format($item->unit_price, 0, ',', '.') }} × {{ $item->quantity }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-orange-500">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Delivery Address -->
            <div class="bg-white rounded-lg border border-slate-200 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Delivery Address</h2>
                <div class="flex gap-3">
                    <span class="text-2xl">📍</span>
                    <p class="text-slate-600">{{ $order->delivery_address }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="md:col-span-1">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg border border-slate-200 p-6 space-y-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-900">Order Summary</h3>

                <div class="space-y-3 border-b border-slate-200 pb-6">
                    <div class="flex justify-between text-slate-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Delivery Fee</span>
                        <span>Rp 15.000</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Tax</span>
                        <span>Rp {{ number_format($order->total * 0.1, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="font-bold text-slate-900">Total</span>
                    <span class="text-2xl font-bold text-orange-500">
                        Rp {{ number_format($order->total + 15000 + ($order->total * 0.1), 0, ',', '.') }}
                    </span>
                </div>

                <!-- Status Timeline -->
                <div class="pt-6 border-t border-slate-200">
                    <h4 class="font-bold text-slate-900 mb-4">Status Timeline</h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm flex-shrink-0">
                                ✓
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900">Order Placed</p>
                                <p class="text-xs text-slate-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full {{ $order->invoice->status === 'paid' ? 'bg-green-500' : 'bg-slate-300' }} flex items-center justify-center text-white text-sm flex-shrink-0">
                                {{ $order->invoice->status === 'paid' ? '✓' : '○' }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900">Payment {{ ucfirst($order->invoice->status) }}</p>
                                @if($order->invoice->paid_at)
                                    <p class="text-xs text-slate-600">{{ $order->invoice->paid_at->format('d M Y H:i') }}</p>
                                @else
                                    <p class="text-xs text-slate-600">Pending</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-300 flex items-center justify-center text-white text-sm flex-shrink-0">
                                ○
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900">Delivered</p>
                                <p class="text-xs text-slate-600">{{ $order->delivery_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="{{ route('customer.orders') }}" class="text-orange-500 hover:text-orange-600 font-medium flex items-center gap-2">
            <span>←</span>
            Back to Orders
        </a>
    </div>
</div>
@endsection