<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Home</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 25px 18px 90px;
        }

        h2 {
            font-size: 22px;
            margin: 0;
        }

        .sub {
            font-size: 15px;
            color: #555;
            margin-top: 2px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .icon-profile {
            width: 34px;
            height: 34px;
            border: 3px solid #2E6F4E;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: #2E6F4E;
            font-size: 20px;
        }

        /* Dropdown profile */
        .dropdown {
            position: absolute;
            background: #fff;
            top: 60px;
            right: 20px;
            width: 130px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, .2);
            display: none;
        }

        .dropdown a {
            display: block;
            padding: 12px;
            font-size: 14px;
            text-decoration: none;
            color: #333;
        }

        .dropdown a:hover {
            background: #f2f2f2;
        }

        .dropdown .logout {
            color: red;
        }

        /* Search bar */
        .search-area {
            margin-top: 22px;
            display: flex;
        }

        .search-area input {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, .1);
            font-size: 15px;
        }

        .search-btn {
            margin-left: 6px;
            width: 42px;
            height: 42px;
            background: #2E6F4E;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: white;
            font-size: 20px;
        }

        /* Menu Grid */
        .menu-title {
            margin-top: 25px;
            font-weight: bold;
            font-size: 16px;
        }

        .menu-grid {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            cursor: pointer;
        }

        .menu-item {
            border: 1px solid #e4e4e4;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .06);
        }

        .menu-item img {
            width: 105px;
            height: 100px;          /* ukuran tinggi dibuat seragam */
            object-fit: cover;      /* gambar tidak melar, hanya dipotong rapi */
            border-radius: 8px;
        }

        .menu-item p {
            margin: 8px 0 3px;
            font-weight: 600;
        }

        .price {
            font-size: 14px;
            color: #444;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
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
            text-align: center;
            cursor: pointer;
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

        <!-- TOP BAR -->
        <div class="top-bar">
            <div>
                <h2>Cari Menu Favoritmu</h2>
                <div class="sub">Pesan & Nikmati</div>
            </div>

            <div class="icon-profile" onclick="toggleDropdown()">
                <i class="fa-solid fa-user user-icon"></i>
            </div>

            <div class="dropdown" id="dropdownMenu">
                <a href="/profil">Profil</a>
                <a href="/logout" class="logout">Keluar</a>
            </div>
        </div>

        <!-- SEARCH BAR -->
        <form class="search-area" method="GET" action="/home">
            <input type="text" name="q" placeholder="Cari minumanmu" value="{{ $search }}">
            <button class="search-btn">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </button>
        </form>

        <!-- MENU GRID -->
        <div class="menu-title">Paling Populer</div>

        <div class="menu-grid">
            @forelse($menus as $m)
                <div class="menu-item" onclick="location.href='/menu/{{ $m['nama'] }}'">
                    <img src="/images/menu/{{ $m['gambar'] }}">
                    <p>{{ $m['nama'] }}</p>
                    <div class="price">Rp {{ number_format($m['harga'], 0, ',', '.') }}</div>
                </div>
            @empty
                <p>Tidak ada hasil</p>
            @endforelse
        </div>

    </div>

    <!-- NAV BOTTOM -->
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

    <script>
        function toggleDropdown() {
            let d = document.getElementById("dropdownMenu");
            d.style.display = d.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(e) {
            if (!e.target.closest(".icon-profile") && !e.target.closest("#dropdownMenu")) {
                document.getElementById("dropdownMenu").style.display = "none";
            }
        });
    </script>

</body>

</html>
