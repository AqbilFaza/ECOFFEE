<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(Request $r) {
        $menus = [
            ['nama'=>'Cappuccino','harga'=>20000,'gambar'=>'cappuccino.png'],
            ['nama'=>'Espresso','harga'=>15000,'gambar'=>'espresso.png'],
            ['nama'=>'Americano','harga'=>18000,'gambar'=>'americano.png'],
            ['nama'=>'Kopi Gula Aren','harga'=>15000,'gambar'=>'aren.png'],
        ];

        if ($r->q) {
            $menus = array_filter($menus, fn($m) =>
                stripos($m['nama'], $r->q) !== false
            );
        }

        return view('home', [
            'menus' => $menus,
            'search'=> $r->q
        ]);
    }
}
