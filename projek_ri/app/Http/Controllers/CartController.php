<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        Cart::create([
            'customer_id' => session('customer_id'),
            'menu_id' => $request->menu_id,
            'qty' => $request->qty
        ]);

        return redirect('/cart');
    }

    public function index()
    {
        $cart = Cart::where('customer_id', session('customer_id'))
                    ->with('menu')
                    ->get();
        return view('cart.index', compact('cart'));
    }
}

