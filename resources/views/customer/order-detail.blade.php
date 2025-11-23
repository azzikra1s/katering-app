<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <h3 class="text-lg font-bold mb-4">Invoice: {{ $order->invoice->invoice_number }}</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p><strong>Merchant:</strong> {{ $order->merchant->company_name }}</p>
                        <p><strong>Phone:</strong> {{ $order->merchant->phone_number }}</p>
                    </div>
                    <div>
                        <p><strong>Delivery Date:</strong> {{ $order->delivery_date->format('d M Y') }}</p>
                        <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                    </div>
                </div>
                <p><strong>Status:</strong> 
                    <span class="px-2 py-1 rounded text-xs {{ $order->invoice->status == 'paid' ? 'bg-green-200' : 'bg-yellow-200' }}">
                        {{ ucfirst($order->invoice->status) }}
                    </span>
                </p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Order Items</h3>
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Menu</th>
                            <th class="px-4 py-2 text-left">Quantity</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $item->menu->name }}</td>
                                <td class="px-4 py-2">{{ $item->quantity }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-right font-bold">Total:</td>
                            <td class="px-4 py-2 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>