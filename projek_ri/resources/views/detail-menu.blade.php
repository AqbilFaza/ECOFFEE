<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>{{ $nama }}</title>

    <style>
        body { 
            font-family: Arial; 
            margin: 0; 
            background: #fff; 
            display: flex; 
            justify-content: center;
        }

        .container { 
            width: 100%; 
            max-width: 480px; 
            padding: 20px; 
            padding-bottom: 130px; /* ★ memberi ruang agar tombol tidak tertutup nav */
        }

        .top {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            margin-bottom: 10px;
        }

        .icon { font-size: 24px; cursor: pointer; }

        .menu-img { 
            width: 100%; 
            max-width: 260px; 
            display: block; 
            margin: 20px auto; 
        }

        .qty-area { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            margin-top: 20px; 
        }

        .btn { 
            width: 40px; 
            height: 40px; 
            background: #2E6F4E; 
            color: #fff; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 22px; 
        }

        .jumlah { margin: 0 25px; font-size: 22px; }

        /* ★ PERBAIKAN: tombol ditengah + block + width otomatis */
        .cart-btn {
            margin: 40px auto 0 auto;  /* center button */
            background: #2E6F4E; 
            color: white; 
            padding: 15px; 
            border-radius: 12px; 
            text-align: center; 
            font-size: 17px; 
            cursor: pointer;
            display: block; /* agar margin auto bekerja */
            width: 100%; 
            max-width: 320px; /* biar responsif & tetap rapi */
        }

        /* NAVIGASI BAWAH */
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

    <div class="top">
        <div class="icon" onclick="history.back()">
            <i class="fa-solid fa-angle-left back-icon"></i>
        </div>
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
        <a href="/home">
            <i class="fa-solid fa-house home-icon active"></i>
        </a>
        <a href="/keranjang">
            <i class="fa-solid fa-cart-shopping cart-icon"></i>
        </a>
        <a href="/riwayat">
            <i class="fa-solid fa-clock-rotate-left history-icon"></i>
        </a>
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
