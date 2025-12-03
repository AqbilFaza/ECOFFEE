<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $nama }}</title>

    <style>
        body { font-family: Arial; margin: 0; background: #fff; display: flex; justify-content: center; }
        .container { width: 100%; max-width: 480px; padding: 20px; }

        .top {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 10px;
        }

        .icon { font-size: 24px; cursor: pointer; }

        .menu-img { width: 100%; max-width: 260px; display: block; margin: 20px auto; }

        .qty-area { display: flex; justify-content: center; align-items: center; margin-top: 20px; }
        .btn { width: 40px; height: 40px; background: #2E6F4E; color: #fff; display: flex; justify-content: center; align-items: center; border-radius: 8px; cursor: pointer; font-size: 22px; }
        .jumlah { margin: 0 25px; font-size: 22px; }

        .cart-btn {
            margin-top: 35px; background: #2E6F4E; color: white; padding: 15px;
            border-radius: 12px; text-align: center; font-size: 17px; cursor: pointer;
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

    <div class="top">
        <div class="icon" onclick="history.back()">←</div>
        <div class="icon">♡</div>
    </div>

    <h2 style="text-align:center;">{{ $nama }}</h2>
    <div style="text-align:center; color:#666;">Rp {{ number_format($harga,0,',','.') }}</div>

    <img class="menu-img" src="/images/menu/{{ $gambar }}">

    <div class="qty-area">
        <div class="btn" onclick="ubahQty(-1)">−</div>
        <div class="jumlah" id="jumlah">1</div>
        <div class="btn" onclick="ubahQty(1)">+</div>
    </div>

    <form method="POST" action="/keranjang/add">
        @csrf
        <input type="hidden" name="nama" value="{{ $nama }}">
        <input type="hidden" name="harga" value="{{ $harga }}">
        <input type="hidden" name="gambar" value="{{ $gambar }}">
        <input type="hidden" name="qty" id="qtyInput" value="1">

        <button class="cart-btn">TAMBAH KE KERANJANG</button>
    </form>

</div>

<div class="bottom-nav">
    <div class="inner">
        <a href="/home">🏠</a>
        <a href="/keranjang">🛒</a>
        <a href="/riwayat">⏱️</a>
    </div>
</div>

<script>
function ubahQty(i) {
    let q = parseInt(document.getElementById("jumlah").innerText) + i;
    if (q < 1) q = 1;
    document.getElementById("jumlah").innerText = q;
    document.getElementById("qtyInput").value = q;
}
</script>

</body>
</html>
