<x-app-layout>
    @section('title', 'Pesanan Masuk - Marketplace Katering')

    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">Pesanan Masuk</h1>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('merchant.orders.detail', $order) }}" class="block bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $order->user->name }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $order->invoice->invoice_number }}</p>
                            </div>
                            <span class="inline-block px-3 py-1 rounded text-xs font-medium {{ $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $order->invoice->status === 'paid' ? 'Lunas' : 'Menunggu' }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                            <div>
                                <p class="text-xs text-gray-600">Tanggal Pesan</p>
                                <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Pengiriman</p>
                                <p class="font-medium text-gray-900">{{ $order->delivery_date->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Item</p>
                                <p class="font-medium text-gray-900">{{ $order->orderItems()->count() }} item</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Total</p>
                                <p class="font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($orders->hasPages())
                <div class="flex justify-center">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                <p class="text-gray-600">Belum ada pesanan</p>
            </div>
        @endif
    </div>
</x-app-layout>