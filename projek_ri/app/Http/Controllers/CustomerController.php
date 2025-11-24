<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function form()
    {
        return view('customer.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_meja' => 'required'
        ]);

        $customer = Customer::create($request->all());
        session(['customer_id' => $customer->id]);

        return redirect('/home');
    }
}

