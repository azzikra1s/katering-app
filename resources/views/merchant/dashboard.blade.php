<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Merchant Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">{{ $merchant->company_name }}</h3>
                <p><strong>Address:</strong> {{ $merchant->address ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $merchant->phone_number ?? '-' }}</p>
                <p><strong>Description:</strong> {{ $merchant->description ?? '-' }}</p>
                <a href="{{ route('merchant.profile') }}" class="text-blue-500 mt-2 inline-block">Edit Profile</a>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-gray-600">Total Orders</h4>
                    <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-gray-600">Total Revenue</h4>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-gray-600">Total Menus</h4>
                    <p class="text-3xl font-bold">{{ $totalMenus }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Quick Actions</h3>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('merchant.menus.index') }}" class="block bg-blue-500 text-white px-4 py-2 rounded text-center">Manage Menus</a>
                    <a href="{{ route('merchant.orders') }}" class="block bg-green-500 text-white px-4 py-2 rounded text-center">View Orders</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>