<?php

// use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer-form');
});

Route::post('/submit', function () {
    return back()->with('success', 'Data berhasil dikirim!');
});

