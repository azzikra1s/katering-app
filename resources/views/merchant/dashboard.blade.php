<!-- resources/views/merchant/dashboard.blade.php -->
<x-app-layout>
    @section('title', 'Dasbor Katering - Marketplace Katering')

    <div class="space-y-8">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dasbor Katering</h1>
            <p class="text-gray-600 mt-1">Kelola bisnis katering Anda</p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-4 gap-4">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Total Pendapatan</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Menu Aktif</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalMenus }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Rata-rata Pesanan</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, ',', '.') : 0 }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('merchant.menus.create') }}" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition-colors">
                <div class="text-2xl mb-2">➕</div>
                <h3 class="font-bold">Tambah Menu</h3>
                <p class="text-blue-100 text-sm mt-1">Tambahkan menu baru</p>
            </a>
            <a href="{{ route('merchant.menus.index') }}" class="bg-green-600 text-white rounded-lg p-6 hover:bg-green-700 transition-colors">
                <div class="text-2xl mb-2">📋</div>
                <h3 class="font-bold">Kelola Menu</h3>
                <p class="text-green-100 text-sm mt-1">Kelola menu Anda</p>
            </a>
            <a href="{{ route('merchant.orders') }}" class="bg-purple-600 text-white rounded-lg p-6 hover:bg-purple-700 transition-colors">
                <div class="text-2xl mb-2">📦</div>
                <h3 class="font-bold">Pesanan Masuk</h3>
                <p class="text-purple-100 text-sm mt-1">Lihat pesanan baru</p>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Pesanan Terbaru</h2>
            @if(collect($orders)->count() > 0)
                <div class="space-y-3">
                    @foreach(collect($orders)->take(5) as $order)
                        <a href="{{ route('merchant.orders.detail', $order) }}" class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div>
                                <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $order->delivery_date->format('d M Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="inline-block px-2 py-1 rounded text-xs font-medium {{ $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $order->invoice->status === 'paid' ? 'Lunas' : 'Pending' }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">Belum ada pesanan</p>
            @endif
        </div>
    </div>
</x-app-layout>