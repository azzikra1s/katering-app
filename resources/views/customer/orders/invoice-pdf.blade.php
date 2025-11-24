<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->invoice->invoice_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; padding: 20px; }
        .title { font-size: 22px; font-weight: bold; }
        .section { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<div class="section">
    <div class="title">{{ $order->merchant->company_name }}</div>
    <p>Invoice: <strong>{{ $order->invoice->invoice_number }}</strong></p>
    <p>Status: <strong>{{ ucfirst($order->invoice->status) }}</strong></p>
</div>

<div class="section">
    <h3>Informasi Pesanan</h3>
    <p>Tanggal Pesan: {{ $order->created_at->format('d M Y H:i') }}</p>
    <p>Tanggal Pengiriman: {{ $order->delivery_date->format('d M Y') }}</p>
    <p>Alamat: {{ $order->delivery_address }}</p>
</div>

<div class="section">
    <h3>Detail Item</h3>
    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->menu->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section">
    <h3>Ringkasan Pembayaran</h3>
    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pajak (10%)</td>
            <td class="text-right">Rp {{ number_format($order->total * 0.1, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <th class="text-right">Rp {{ number_format($order->total + ($order->total * 0.1), 0, ',', '.') }}</th>
        </tr>
    </table>
</div>

</body>
</html>
