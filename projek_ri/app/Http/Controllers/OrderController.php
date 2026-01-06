<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller {

    public function metode() {
        return view('metode-bayar');
    }

    public function store() {
        $cart = session('cart', []);
        abort_if(empty($cart), 404);

        $total = collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);

        $order = Order::create([
            'customer_id' => session('customer_id'),
            'metode_bayar'=> 'TUNAI',
            'status'      => 'MENUNGGU_PEMBAYARAN',
            'total'       => $total
        ]);

        foreach ($cart as $c) {
            OrderItem::create([
                'order_id' => $order->id,
                'nama'     => $c['nama'],
                'harga'    => $c['harga'],
                'qty'      => $c['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect('/menunggu-bayar');
    }

    public function riwayat() {
        $orders = Order::with('customer')
            ->where('customer_id', session('customer_id'))
            ->latest()
            ->get();

        return view('riwayat', compact('orders'));
    }

    public function status(Order $order){
        // keamanan: hanya bisa lihat pesanan sendiri
        if ($order->customer_id !== session('customer_id')) {
            abort(403);
        }

        return view('status-pesanan', compact('order'));
    }
}