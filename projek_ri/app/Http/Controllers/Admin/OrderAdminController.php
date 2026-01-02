<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderAdminController extends Controller {

    public function index() {
        $orders = Order::with('customer')
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function confirm(Order $order) {
        $order->update([
            'status' => 'LUNAS'
        ]);

        return back()->with('success', 'Pembayaran dikonfirmasi');
    }
}
