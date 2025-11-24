<!-- resources/views/customer/dashboard.blade.php -->
<x-app-layout>
    @section('title', 'Dasbor Kantor - Marketplace Katering')

    <div class="space-y-8">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dasbor Kantor</h1>
            <p class="text-gray-600 mt-1">Selamat datang, {{ auth()->user()->name }}</p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ auth()->user()->orders()->count() }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Total Pengeluaran</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">Rp {{ number_format(auth()->user()->orders()->sum('total'), 0, ',', '.') }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <p class="text-gray-600 text-sm font-medium">Pesanan Pending</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ auth()->user()->orders()->where('status', 'pending')->count() }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-4">
            <a href="{{ route('customer.merchants') }}" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition-colors">
                <div class="text-2xl mb-2">🔍</div>
                <h3 class="font-bold">Cari Katering Baru</h3>
                <p class="text-blue-100 text-sm mt-1">Temukan katering pilihan Anda</p>
            </a>
            <a href="{{ route('customer.cart') }}" class="bg-green-600 text-white rounded-lg p-6 hover:bg-green-700 transition-colors">
                <div class="text-2xl mb-2">🛒</div>
                <h3 class="font-bold">Pesanan Saya</h3>
                <p class="text-green-100 text-sm mt-1">Lihat daftar pesanan</p>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Pesanan Terbaru</h2>
            @if(auth()->user()->orders()->count() > 0)
                <div class="space-y-3">
                    @foreach(auth()->user()->orders()->latest()->take(5)->get() as $order)
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-900">{{ $order->merchant->company_name }}</p>
                                <p class="text-sm text-gray-600">{{ $order->delivery_date->format('d M Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="inline-block px-3 py-1 rounded text-xs font-medium {{ $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $order->invoice->status === 'paid' ? 'Lunas' : 'Menunggu' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">Belum ada pesanan. Mulai pesan sekarang!</p>
            @endif
        </div>
    </div>
</x-app-layout>