<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            justify-content: center;
            background: #fff;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
            padding-bottom: 140px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .left-number {
            font-size: 20px;
            font-weight: bold;
            width: 30px;
            text-align: center;
        }

        .middle-info {
            text-align: left;
            flex: 1;
        }

        .status {
            color: green;
            font-weight: bold;
        }

        .link-status a {
            color: #1a7f5a;
            cursor: pointer;
            white-space: nowrap;
            text-align: right;
            text-decoration: none;
        }

        /* nav bawah */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 15px 0;
            display: flex;
            justify-content: center;
            box-shadow: 0 -3px 10px rgba(0,0,0,.1);
        }

        .bottom-inner {
            width: 100%;
            max-width: 480px;
            display: flex;
            justify-content: space-around;
        }

        .bottom-inner a {
            font-size: 20px;
            color: #7a7a7a;
            text-decoration: none;
        }

        .active { color: #2E6F4E; }
    </style>
</head>

<body>

<div class="container">
    <h2 style="text-align:center;">Riwayat Pesanan</h2>

    @forelse($orders as $i => $o)
        <div class="item">

            <!-- Nomor di kiri tengah -->
            <div class="left-number">{{ $i+1 }}</div>

            <!-- Info pesanan di tengah -->
            <div class="middle-info">
                <div>{{ $o->customer->nama }}</div>
                <div>Meja: {{ $o->customer->meja }}</div>
                <div>{{ $o->created_at->format('d/m/Y H:i') }}</div>
                <!-- <div>Tunai (<span class="status">{{ $o->status }}</span>)</div> -->
                <div>Tunai (<span class="status">
                    {{ $o->status === 'LUNAS' ? 'LUNAS' : 'MENUNGGU PEMBAYARAN' }}
                </span>)</div>
            </div>

            <!-- Lihat status di kanan tengah -->
            <div class="link-status">
                <a href="/status/{{ $o->id }}">Lihat Status</a>
            </div>

        </div>
    @empty
        <p>Belum ada pesanan.</p>
    @endforelse

</div>

<div class="bottom-nav">
    <div class="bottom-inner">
        <a href="/home"><i class="fa-solid fa-house"></i></a>
        <a href="/keranjang"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="/riwayat"><i class="fa-solid fa-clock-rotate-left active"></i></a>
    </div>
</div>

</body>
</html>
