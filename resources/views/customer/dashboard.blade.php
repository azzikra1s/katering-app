<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customer Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-gray-600">Total Orders</h4>
                    <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-gray-600">Total Spent</h4>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('customer.merchants') }}" class="block bg-blue-500 text-white px-4 py-2 rounded text-center">Browse Merchants</a>
                    <a href="{{ route('customer.cart') }}" class="block bg-green-500 text-white px-4 py-2 rounded text-center">View Cart</a>
                    <a href="{{ route('customer.orders') }}" class="block bg-gray-500 text-white px-4 py-2 rounded text-center">My Orders</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>