<?php

namespace App\Http\Controllers;

class MenuController extends Controller {
    public function show($nama) {
        $menus = [
            'Cappuccino'=>['harga'=>20000,'gambar'=>'cappuccino.png'],
            'Espresso'=>['harga'=>15000,'gambar'=>'espresso.png'],
            'Americano'=>['harga'=>18000,'gambar'=>'americano.png'],
            'Kopi Gula Aren'=>['harga'=>15000,'gambar'=>'aren.png'],
        ];

        abort_unless(isset($menus[$nama]), 404);

        return view('detail-menu', [
            'nama'=>$nama,
            'harga'=>$menus[$nama]['harga'],
            'gambar'=>$menus[$nama]['gambar'],
        ]);
    }
}