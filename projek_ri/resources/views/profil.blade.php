<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Edit Profil</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 30px 20px 90px;
        }

        h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .back-btn {
            font-size: 20px;
            cursor: pointer;
            margin-right: 10px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            margin-top: 18px;
            display: block;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 6px;
            font-size: 15px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 30px;
            background: #2E6F4E;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .alert {
            background: #D1FFD1;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 14px;
            border-left: 5px solid #2E6F4E;
        }

        /* Bottom navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 15px 0;
            display: flex;
            justify-content: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, .1);
        }

        .bottom-inner {
            width: 100%;
            max-width: 480px;
            display: flex;
            justify-content: space-around;
        }

        .nav-item {
            text-decoration: none;
            font-size: 20px;
            cursor: pointer;
            color: #7a7a7aff;
        }

        .active {
            color: #2E6F4E;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div class="back-btn" onclick="history.back()">
            <i class="fa-solid fa-angle-left back-icon"></i>
        </div>
        <h2>Edit Data Pelanggan</h2>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form action="/profil/update" method="POST">
        @csrf

        <label>Nama Lengkap</label>
        <input type="text" name="nama" id="nama" value="{{ $nama }}">
        <small id="error-nama" style="color:red;"></small>

        <label>Nomor HP</label>
        <input type="text" name="hp" id="hp" value="{{ $hp }}">
        <small id="error-hp" style="color:red;"></small>

        <label>Nomor Meja</label>
        <input type="text" name="meja" id="meja" value="{{ $meja }}">
        <small id="error-meja" style="color:red;"></small>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <script>
    const nama  = document.getElementById('nama');
    const hp    = document.getElementById('hp');
    const meja  = document.getElementById('meja');
    const btn   = document.querySelector('button');

    function validateNama() {
        if (!/^[a-zA-Z\s]+$/.test(nama.value)) {
            document.getElementById('error-nama').innerText = 
                'Nama tidak boleh mengandung angka atau simbol';
            return false;
        }
        document.getElementById('error-nama').innerText = '';
        return true;
    }

    function validateHP() {
        if (!/^[0-9]{10,13}$/.test(hp.value)) {
            document.getElementById('error-hp').innerText = 
                'Nomor HP harus 10–13 digit angka';
            return false;
        }
        document.getElementById('error-hp').innerText = '';
        return true;
    }

    function validateMeja() {
        if (!/^[0-9]+$/.test(meja.value)) {
            document.getElementById('error-meja').innerText = 
                'Nomor meja harus berupa angka';
            return false;
        }
        document.getElementById('error-meja').innerText = '';
        return true;
    }

    // realtime validation
    nama.addEventListener('input', validateNama);
    hp.addEventListener('input', validateHP);
    meja.addEventListener('input', validateMeja);

    // cegah submit jika error
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateNama() || !validateHP() || !validateMeja()) {
            e.preventDefault();
        }
    });
    </script>

</div>

<!-- Bottom Navigation -->
<div class="bottom-nav">
    <div class="bottom-inner">

        <a href="/home" class="nav-item active">
            <i class="fa-solid fa-house home-icon"></i>
        </a>
        <a href="/keranjang" class="nav-item">
            <i class="fa-solid fa-cart-shopping cart-icon"></i>
        </a>
        <a href="/riwayat" class="nav-item">
            <i class="fa-solid fa-clock-rotate-left history-icon"></i>
        </a>

    </div>
</div>

</body>

</html>