<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan</title>

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

        /* PROGRESS */
        .progress {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
        }

        .circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 3px solid #2E6F4E;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2E6F4E;
            font-weight: bold;
        }

        .circle.active {
            background: #2E6F4E;
            color: #fff;
        }

        .line {
            width: 60px;
            height: 3px;
            background: #2E6F4E;
        }

        /* CONTENT */
        .content {
            padding: 20px;
        }

        .status-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            margin-bottom: 50px;
        }

        .status-row i {
            font-size: 30px;
        }

        .big-text {
            font-size: 22px;
            font-weight: bold;
            line-height: 1.4;
        }

        /* BOTTOM NAV */
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

        .active {
            color: #2E6F4E;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <a href="/riwayat" class="back-btn"><i class="fa-solid fa-angle-left back-icon"></i></a>

    <h2>Status Pesanan</h2>

    <!-- PROGRESS -->
    <div class="progress">
        <div class="circle active">✔</div>
        <div class="line"></div>
        <div class="circle {{ $order->status === 'LUNAS' ? 'active' : '' }}">
            {{ $order->status === 'LUNAS' ? '✔' : '2' }}
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @if($order->status === 'MENUNGGU_PEMBAYARAN')
            <div class="status-row">
                <i class="fa-regular fa-clipboard"></i>
                <span>Diterima</span>
            </div>

            <div class="big-text">
                PESANAN ANDA<br>
                SEDANG DIPROSES!
            </div>
        @else
            <div class="status-row">
                <i class="fa-regular fa-clock"></i>
                <span>Disiapkan</span>
            </div>

            <div class="big-text">
                PESANAN ANDA<br>
                SEDANG DISIAPKAN!
            </div>
        @endif
    </div>

</div>

<!-- BOTTOM NAV -->
<div class="bottom-nav">
    <div class="bottom-inner">
        <a href="/home"><i class="fa-solid fa-house"></i></a>
        <a href="/keranjang"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="/riwayat" class="active">
            <i class="fa-solid fa-clock-rotate-left active"></i>
        </a>
    </div>
</div>

</body>
</html>
