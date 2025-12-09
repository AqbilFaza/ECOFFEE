<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Keranjang</title>

    <style>
        body { font-family: Arial; margin: 0; display: flex; justify-content: center; background: #fff; }

        .container { 
            width: 100%; 
            max-width: 480px; 
            padding: 20px;
            padding-bottom: 150px; /* ★ agar total & tombol pesan tidak ketutup nav */
        }

        .item {
            display: flex; 
            align-items: center;
            border: 1px solid #eee; 
            padding: 12px; 
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .item img { width: 60px; border-radius: 10px; }
        .info { margin-left: 12px; flex: 1; }

        /* Tombol + - */
        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-qty {
            width: 32px;
            height: 32px;
            background: #2E6F4E;
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }

        .qty-text {
            font-size: 18px;
            min-width: 20px;
            text-align: center;
        }

        .total-area { 
            margin-top: 25px; 
            font-size: 17px; 
            display: flex; 
            justify-content: space-between; 
        }

        .pesan-btn {
            margin-top: 20px; 
            background: #2E6F4E; 
            color: #fff; 
            padding: 15px;
            border-radius: 12px; 
            text-align: center; 
            cursor: pointer; 
            font-size: 18px;
        }

        /* NAV BAWAH */
        .bottom-nav {
            position: fixed; 
            bottom: 0; 
            left: 0; 
            width: 100%; 
            background: #fff;
            padding: 15px 0; 
            display: flex; 
            justify-content: center; 
            box-shadow: 0 -2px 10px rgba(0,0,0,.1);
        }

        .inner { 
            width: 100%; 
            max-width: 480px; 
            display: flex; 
            justify-content: space-around; 
        }

        .inner a {
            color: #7a7a7aff;
            font-size: 20px;
        }

        .active {
            color: #2E6F4E;
            font-weight: bold;
        }

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

            <!-- Kontrol tambah/kurang qty -->
            <div class="qty-control">
                
                <!-- MINUS -->
                <form method="POST" action="/keranjang/update-qty">
                    @csrf
                    <input type="hidden" name="nama" value="{{ $c['nama'] }}">
                    <input type="hidden" name="aksi" value="minus">
                    <button class="btn-qty">−</button>
                </form>

                <div class="qty-text">{{ $c['qty'] }}</div>

                <!-- PLUS -->
                <form method="POST" action="/keranjang/update-qty">
                    @csrf
                    <input type="hidden" name="nama" value="{{ $c['nama'] }}">
                    <input type="hidden" name="aksi" value="plus">
                    <button class="btn-qty">+</button>
                </form>

            </div>

        </div>
    @empty
        <p>Keranjang kosong</p>
    @endforelse

    <div class="total-area">
        <div><b>Total Biaya</b></div>
        <div>Rp {{ number_format($total,0,',','.') }}</div>
    </div>

    @if($total > 0)
        <div class="pesan-btn">
            <a href="/metode-bayar" style="text-decoration:none; color:white; display:block;">
                PESAN
            </a>
        </div>
    @else
        <div class="pesan-btn" style="background:#b5b5b5; pointer-events:none;">
            PESAN
        </div>
    @endif
    

</div>

<!-- NAV BAWAH -->
<div class="bottom-nav">
    <div class="inner">
        <a href="/home">
            <i class="fa-solid fa-house home-icon"></i>
        </a>
        <a href="/keranjang">
            <i class="fa-solid fa-cart-shopping cart-icon active"></i>
        </a>
        <a href="/riwayat">
            <i class="fa-solid fa-clock-rotate-left history-icon"></i>
        </a>
    </div>
</div>

</body>
</html>
