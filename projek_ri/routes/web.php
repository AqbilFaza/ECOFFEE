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

Route::get('/profil', fn() => "Halaman profil user");
Route::get('/keranjang', fn() => "Halaman keranjang");
Route::get('/riwayat', fn() => "Halaman riwayat");

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});