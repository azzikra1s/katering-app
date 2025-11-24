<x-app-layout>
    @section('title', 'Keranjang Pesanan - Marketplace Katering')

    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-gray-900">Keranjang Pesanan</h1>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Items -->
            <div class="lg:col-span-2">
                @if(count($cart) > 0)
                    <div class="space-y-4">
                        @php
                            $groupedByMerchant = [];
                            foreach($cart as $item) {
                                $merchantId = $item['merchant_id'];
                                if (!isset($groupedByMerchant[$merchantId])) {
                                    $groupedByMerchant[$merchantId] = [
                                        'merchant_name' => $item['merchant_name'],
                                        'items' => []
                                    ];
                                }
                                $groupedByMerchant[$merchantId]['items'][] = $item;
                            }
                        @endphp

                        @foreach($groupedByMerchant as $merchantId => $merchantGroup)
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <h3 class="font-bold text-gray-900 mb-4">{{ $merchantGroup['merchant_name'] }}</h3>
                                <div class="space-y-3">
                                    @foreach($merchantGroup['items'] as $item)
                                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item['name'] }}</p>
                                                <p class="text-sm text-gray-600">{{ $item['quantity'] }} × Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                                <form action="{{ route('customer.cart.remove', $item['menu_id']) }}" method="POST" class="mt-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-700 text-xs font-medium">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                        <p class="text-gray-600 mb-4">Keranjang kosong</p>
                        <a href="{{ route('customer.merchants') }}" class="text-blue-600 hover:text-blue-700 font-medium">Lanjutkan berbelanja</a>
                    </div>
                @endif
            </div>

            <!-- Summary & Checkout -->
            @if(count($cart) > 0)
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-24 space-y-4">
                        <h3 class="font-bold text-gray-900">Ringkasan Pesanan</h3>

                        <div class="space-y-2 pb-4 border-b border-gray-200">
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Pajak (10%)</span>
                                <span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between font-bold text-lg text-gray-900">
                            <span>Total</span>
                            <span>Rp {{ number_format($total + ($total * 0.1), 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('customer.checkout') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
                                <textarea name="delivery_address" rows="3" required
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                    placeholder="Alamat lengkap kantor Anda"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengiriman</label>
                                <input type="date" name="delivery_date" required 
                                    x-data x-init="$el.min = new Date().toISOString().split('T')[0]"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors py-3">
                                Lakukan Pemesanan
                            </button>
                        </form>

                        <a href="{{ route('customer.merchants') }}" class="block text-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                            Lanjutkan berbelanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>