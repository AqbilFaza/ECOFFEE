<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // =========================
    // FORM DATA PELANGGAN
    // =========================
    public function form()
    {
        if (session()->has('customer_id')) {
            return redirect('/home');
        }

        return view('customer-form');
    }

    public function store(Request $request)
    {
        $customer = Customer::create([
            'nama' => $request->nama,
            'hp'   => $request->hp,
            'meja' => $request->meja,
        ]);

        // Simpan customer ID ke session
        session(['customer_id' => $customer->id]);

        return redirect('/home');
    }

    // =========================
    // PROFIL
    // =========================
    public function profil()
    {
        $customer = Customer::findOrFail(session('customer_id'));

        return view('profil', [
            'nama' => $customer->nama,
            'hp'   => $customer->hp,
            'meja' => $customer->meja,
        ]);
    }

    public function updateProfil(Request $request)
    {
        $customer = Customer::findOrFail(session('customer_id'));

        $customer->update([
            'nama' => $request->nama,
            'hp'   => $request->hp,
            'meja' => $request->meja,
        ]);

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}