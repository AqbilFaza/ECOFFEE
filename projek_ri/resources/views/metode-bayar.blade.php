<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Bayar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial;
            margin: 0;
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

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* tombol back */
        .back-btn {
            font-size: 24px;
            text-decoration: none;
            color: black;
            display: inline-block;
            margin-bottom: 10px;
        }

        .pay-box {
            border: 2px solid #bfbfbf;   /* SEBELUM DIPILIH = abu-abu */
            border-radius: 10px;
            padding: 12px;
            width: 140px;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .pay-box.selected {
            border: 2px solid #2E6F4E; /* setelah dipilih = hijau */
        }

        .pay-box img {
            width: 45px;
            margin-bottom: 8px;
        }

        .pay-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 10px;
        }

        .confirm-btn {
            margin-top: 25px;
            background: #a8a8a8;        /* SEBELUM AKTIF = abu */
            color: #fff;
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-size: 18px;
            border: none;
            cursor: not-allowed;        /* tidak aktif */
            opacity: 0.6;
            transition: 0.2s;
        }

        .confirm-btn.active {
            background: #2E6F4E;        /* AKTIF = hijau */
            cursor: pointer;
            opacity: 1;
            color: #fff;
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

    <a href="/keranjang" class="back-btn"><i class="fa-solid fa-angle-left back-icon"></i></a>

    <h2>Metode Bayar</h2>

    <div class="pay-container">
        <div class="pay-box" id="payTunai">
            <img src="https://cdn-icons-png.flaticon.com/512/1998/1998611.png">
            <div><b>Tunai</b></div>
        </div>
    </div>

    <form method="POST" action="/bayar/konfirmasi">
        @csrf
        <button id="confirmBtn" class="confirm-btn" disabled>KONFIRMASI & BAYAR</button>
    </form>

</div>

<div class="bottom-nav">
    <div class="bottom-inner">
        <a href="/home"><i class="fa-solid fa-house"></i></a>
        <a href="/keranjang"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="/riwayat" class="active"><i class="fa-solid fa-clock-rotate-left"></i></a>
    </div>
</div>

<script>
    const payBox = document.getElementById('payTunai');
    const confirmBtn = document.getElementById('confirmBtn');

    payBox.addEventListener('click', function () {
        // ubah border tunai menjadi hijau
        payBox.classList.add('selected');

        // aktifkan tombol konfirmasi
        confirmBtn.classList.add('active');
        confirmBtn.disabled = false;
        confirmBtn.style.cursor = "pointer";
    });
</script>

</body>
</html>
