<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>

    <style>
        body { font-family: Arial; margin: 0; display: flex; justify-content: center; }
        .container { width: 100%; max-width: 480px; padding: 20px; }

        .item {
            display: flex; align-items: center;
            border: 1px solid #eee; padding: 12px; border-radius: 12px;
            margin-bottom: 12px;
        }

        .item img { width: 60px; border-radius: 10px; }
        .info { margin-left: 12px; flex: 1; }
        .qty { font-weight: bold; }

        .total-area { margin-top: 20px; font-size: 17px; display: flex; justify-content: space-between; }

        .pesan-btn {
            margin-top: 20px; background: #2E6F4E; color: #fff; padding: 15px;
            border-radius: 12px; text-align: center; cursor: pointer; font-size: 18px;
        }

        .bottom-nav {
            position: fixed; bottom: 0; left: 0; width: 100%; background: #fff;
            padding: 15px 0; display: flex; justify-content: center; box-shadow: 0 -2px 10px rgba(0,0,0,.1);
        }

        .inner { width: 100%; max-width: 480px; display: flex; justify-content: space-around; }
    </style>
</head>

<body>
<div class="container">

    <h2 style="text-align:center;">Keranjang</h2>

    @forelse($cart as $c)
        <div class="item">
            <img src="/images/menu/{{ $c['gambar'] }}">
            <div class="info">
                <div>{{ $c['nama'] }}</div>
                <div>Rp {{ number_format($c['harga'],0,',','.') }}</div>
            </div>
            <div class="qty">{{ $c['qty'] }}x</div>
        </div>
    @empty
        <p>Keranjang kosong</p>
    @endforelse

    <div class="total-area">
        <div><b>Total Biaya</b></div>
        <div>Rp {{ number_format($total,0,',','.') }}</div>
    </div>

    <div class="pesan-btn">PESAN</div>

</div>

<div class="bottom-nav">
    <div class="inner">
        <a href="/home">🏠</a>
        <a href="/keranjang" class="active">🛒</a>
        <a href="/riwayat">⏱️</a>
    </div>
</div>

</body>
</html>