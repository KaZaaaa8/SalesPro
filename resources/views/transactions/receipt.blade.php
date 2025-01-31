<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $transaction->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .store-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info {
            font-size: 10px;
            color: #666;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        .invoice-info table {
            width: 100%;
            font-size: 10px;
        }
        .items {
            margin-bottom: 20px;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            text-align: left;
        }
        .items td {
            padding: 5px 0;
        }
        .totals table {
            width: 100%;
            margin-top: 10px;
        }
        .totals td {
            padding: 2px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="store-name">TokoKu</div>
            <div class="store-info">
                Jl. Perintis No.09<br>
                Telp: 021-12345678
            </div>
        </div>

        <div class="invoice-info">
            <table>
                <tr>
                    <td>No. Invoice</td>
                    <td>: {{ $transaction->invoice_number }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: {{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>: {{ $transaction->user->name }}</td>
                </tr>
            </table>
        </div>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>PPN (12%)</td>
                    <td class="text-right">{{ number_format($transaction->tax, 0, ',', '.') }}</td>
                </tr>
                <tr class="bold">
                    <td>Total</td>
                    <td class="text-right">{{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Bayar ({{ ucfirst($transaction->payment_method) }})</td>
                    <td class="text-right">{{ number_format($transaction->payment_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Kembali</td>
                    <td class="text-right">{{ number_format($transaction->change_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
        </div>
    </div>
</body>
</html>
