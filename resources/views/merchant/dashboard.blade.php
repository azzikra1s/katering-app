<!-- resources/views/merchant/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - FoodHub Merchant')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Welcome, {{ $merchant->company_name }}!</h1>
        <p class="text-lg text-slate-600">Manage your restaurant and orders efficiently</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Orders</p>
                    <p class="text-3xl font-bold text-slate-900">{{ $totalOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-xl">
                    📦
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Total Revenue</p>
                    <p class="text-3xl font-bold text-slate-900">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-xl">
                    💰
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Menu Items</p>
                    <p class="text-3xl font-bold text-slate-900">{{ $totalMenus }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-xl">
                    🍽️
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-1">Avg Order Value</p>
                    <p class="text-3xl font-bold text-slate-900">
                        Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, ',', '.') : 0 }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-xl">
                    📊
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Quick Actions</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <a href="{{ route('merchant.menus.create') }}" class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-lg transition-all p-8 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-4xl group-hover:scale-110 transition-transform">➕</div>
                    <svg class="w-5 h-5 text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Add New Menu</h3>
                <p class="text-slate-600">Create and add new dishes to your menu</p>
            </a>

            <a href="{{ route('merchant.menus.index') }}" class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-lg transition-all p-8 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-4xl group-hover:scale-110 transition-transform">🍽️</div>
                    <svg class="w-5 h-5 text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Manage Menu</h3>
                <p class="text-slate-600">Edit and manage your menu items</p>
            </a>

            <a href="{{ route('merchant.orders') }}" class="bg-white rounded-lg border border-slate-200 hover:border-orange-300 hover:shadow-lg transition-all p-8 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-4xl group-hover:scale-110 transition-transform">📦</div>
                    <svg class="w-5 h-5 text-orange-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">View Orders</h3>
                <p class="text-slate-600">Check incoming orders and manage them</p>
            </a>
        </div>
    </div>

    <!-- Merchant Info -->
    <div class="bg-white rounded-lg border border-slate-200 p-8">
        <div class="flex items-start justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Restaurant Information</h2>
            <a href="{{ route('merchant.profile') }}" class="text-orange-500 hover:text-orange-600 font-medium">Edit</a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-slate-600 mb-1">Company Name</p>
                <p class="font-bold text-slate-900">{{ $merchant->company_name }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 mb-1">Phone Number</p>
                <p class="font-bold text-slate-900">{{ $merchant->phone_number ?? 'Not set' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-slate-600 mb-1">Address</p>
                <p class="font-bold text-slate-900">{{ $merchant->address ?? 'Not set' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-slate-600 mb-1">Description</p>
                <p class="font-bold text-slate-900">{{ $merchant->description ?? 'Not set' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection