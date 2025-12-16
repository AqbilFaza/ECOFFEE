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
            <input type="text" name="nama" id="nama">
            <small id="error-nama" style="color:red;"></small>

            <label>Nomor HP</label>
            <input type="text" name="hp" id="hp">
            <small id="error-hp" style="color:red;"></small>

            <label>Nomor Meja</label>
            <input type="text" name="meja" id="meja">
            <small id="error-meja" style="color:red;"></small>

            <button type="submit">SELESAI</button>
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

</body>
</html>
