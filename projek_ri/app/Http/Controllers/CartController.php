<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {

    public function index() {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);
        return view('keranjang', compact('cart','total'));
    }

    public function add(Request $r) {
        $cart = session('cart', []);

        $cart[$r->nama]['nama']   = $r->nama;
        $cart[$r->nama]['harga']  = $r->harga;
        $cart[$r->nama]['gambar'] = $r->gambar;
        $cart[$r->nama]['qty']    = ($cart[$r->nama]['qty'] ?? 0) + $r->qty;

        session(['cart'=>$cart]);
        return redirect('/keranjang');
    }

    public function updateQty(Request $r) {
        $cart = session('cart', []);
        if (!isset($cart[$r->nama])) return back();

        $cart[$r->nama]['qty'] += $r->aksi === 'plus' ? 1 : -1;
        if ($cart[$r->nama]['qty'] <= 0) unset($cart[$r->nama]);

        session(['cart'=>$cart]);
        return back();
    }
}
