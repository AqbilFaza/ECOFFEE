<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('customer-form');
});

Route::post('/submit', function (Request $r) {
    session([
        'nama' => $r->nama,
        'hp'   => $r->hp,
        'meja' => $r->meja,
    ]);
    return redirect('/home');
});

Route::get('/home', function (Request $r) {
    $menus = [
        ['nama' => 'Cappuccino', 'harga' => 20000, 'gambar' => 'cappuccino.png'],
        ['nama' => 'Espresso', 'harga' => 15000, 'gambar' => 'espresso.png'],
        ['nama' => 'Americano', 'harga' => 18000, 'gambar' => 'americano.png'],
        ['nama' => 'Kopi Gula Aren', 'harga' => 15000, 'gambar' => 'aren.png'],
    ];

    $search = $r->query('q');

    if ($search) {
        $menus = array_filter($menus, function ($m) use ($search) {
            return stripos($m['nama'], $search) !== false;
        });
    }

    return view('home', compact('menus', 'search'));
});

Route::get('/profil', function () {
    return view('profil', [
        'nama' => session('nama'),
        'hp'   => session('hp'),
        'meja' => session('meja'),
    ]);
});

Route::post('/profil/update', function (Illuminate\Http\Request $r) {
    session([
        'nama' => $r->nama,
        'hp'   => $r->hp,
        'meja' => $r->meja,
    ]);

    return redirect('/profil')->with('success', 'Profil berhasil diperbarui!');
});



// Halaman detail menu
Route::get('/menu/{nama}', function ($nama) {
    $menus = [
        'Cappuccino'      => ['harga' => 20000, 'gambar' => 'cappuccino.png'],
        'Espresso'        => ['harga' => 15000, 'gambar' => 'espresso.png'],
        'Americano'       => ['harga' => 18000, 'gambar' => 'americano.png'],
        'Kopi Gula Aren'  => ['harga' => 15000, 'gambar' => 'aren.png'],
    ];

    if (!isset($menus[$nama])) abort(404);

    return view('detail-menu', [
        'nama'   => $nama,
        'harga'  => $menus[$nama]['harga'],
        'gambar' => $menus[$nama]['gambar']
    ]);
});

// Proses tambah ke keranjang
Route::post('/keranjang/add', function (Request $r) {
    $cart = session()->get('cart', []);

    if (isset($cart[$r->nama])) {
        $cart[$r->nama]['qty'] += $r->qty;
    } else {
        $cart[$r->nama] = [
            'nama'   => $r->nama,
            'harga'  => $r->harga,
            'gambar' => $r->gambar,
            'qty'    => $r->qty
        ];
    }

    session(['cart' => $cart]);

    return redirect('/keranjang');
});

// Halaman keranjang
Route::get('/keranjang', function () {
    $cart = session('cart', []);
    $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);

    return view('keranjang', compact('cart', 'total'));
});

// Update qty item keranjang (+ / -)
Route::post('/keranjang/update-qty', function (Request $r) {
    $cart = session()->get('cart', []);

    $nama = $r->nama;

    if (!isset($cart[$nama])) {
        return back();
    }

    if ($r->aksi === "plus") {
        $cart[$nama]['qty'] += 1;
    } else {
        $cart[$nama]['qty'] -= 1;

        // Jika qty <= 0 hapus dari keranjang
        if ($cart[$nama]['qty'] <= 0) {
            unset($cart[$nama]);
        }
    }

    session(['cart' => $cart]);
    return back();
});


// Halaman metode bayar
Route::get('/metode-bayar', function () {
    return view('metode-bayar');
});

// Setelah klik Konfirmasi & Bayar → masuk riwayat
Route::post('/bayar/konfirmasi', function () {
    // Simpan riwayat pesanan (sederhana)
    $riwayat = session()->get('riwayat', []);

    $riwayat[] = [
        'nama' => session('nama'),
        'hp'   => session('hp'),
        'meja' => session('meja'),
        'metode' => 'Tunai',
        'status' => 'LUNAS',
        'waktu'  => now()->format('d/m/Y H:i')
    ];

    session(['riwayat' => $riwayat]);
    session()->forget('cart'); // kosongkan keranjang

    return redirect('/riwayat');
});

// Halaman riwayat
Route::get('/riwayat', function () {
    $riwayat = session('riwayat', []);
    return view('riwayat', compact('riwayat'));
});


Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});