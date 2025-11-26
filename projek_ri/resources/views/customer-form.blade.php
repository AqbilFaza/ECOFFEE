<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 30px 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        p {
            font-size: 14px;
            color: #555;
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

        button:hover {
            opacity: 0.9;
        }

        .alert {
            background: #d1ffd1;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* RESPONSIVE FOR LAPTOP */
        @media (min-width: 768px) {
            h1 { font-size: 28px; }
            .container { padding-top: 50px; }
        }

    </style>
</head>
<body>

    <div class="container">

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <h1>Data Pelanggan</h1>
        <p>Isi data dirimu sebelum memesan</p>

        <form method="POST" action="/submit">
            @csrf

            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="masukkan nama" required>

            <label>Nomor HP</label>
            <input type="text" name="hp" placeholder="masukkan nomor hp" required>

            <label>Nomor Meja</label>
            <input type="text" name="hp" placeholder="masukkan nomor hp" required>

            <button type="submit">SELESAI</button>
        </form>
    </div>

</body>
</html>
