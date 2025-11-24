<x-app-layout>
    @section('title', 'Detail Pesanan - Marketplace Katering')

    <div class="space-y-6">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('customer.orders') }}" class="hover:text-blue-600">Pesanan</a>
            <span>/</span>
            <span>{{ $order->invoice->invoice_number }}</span>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Invoice Info -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $order->merchant->company_name }}</h2>
                            <p class="text-gray-600 text-sm mt-1">{{ $order->invoice->invoice_number }}</p>
                        </div>
                        <span class="inline-block px-4 py-2 rounded-lg text-sm font-medium {{ $order->invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $order->invoice->status === 'paid' ? 'Lunas' : 'Menunggu Pembayaran' }}
                        </span>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                        <div>
                            <p class="text-xs text-gray-600">Tanggal Pesan</p>
                            <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Pengiriman</p>
                            <p class="font-medium text-gray-900">{{ $order->delivery_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Alamat</p>
                            <p class="font-medium text-gray-900">{{ Str::limit($order->delivery_address, 30) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Detail Pesanan</h3>
                    <div class="space-y-3">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->menu->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-3">Alamat Pengiriman</h3>
                    <p class="text-gray-700">{{ $order->delivery_address }}</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4 sticky top-24">
                    <h3 class="font-bold text-gray-900">Ringkasan</h3>

                    <div class="space-y-2 pb-4 border-b border-gray-200">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Pajak</span>
                            <span>Rp {{ number_format($order->total * 0.1, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between font-bold text-gray-900">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total + ($order->total * 0.1), 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('customer.orders.invoice.pdf', $order->id) }}" class="w-full block text-center bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-2 text-sm">
                        Cetak Invoice
                    </a>

                    <a href="{{ route('customer.orders') }}" class="block text-center text-gray-600 hover:text-gray-900 font-medium text-sm">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>