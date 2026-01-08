<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    CustomerController,
    HomeController,
    MenuController,
    CartController,
    OrderController
};
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\AuthController;


Route::get('/', [CustomerController::class, 'form']);
Route::post('/submit', [CustomerController::class, 'store']);

// CUSTOMER AREA (PROTECTED)
Route::middleware('customer.auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/menu/{nama}', [MenuController::class, 'show']);

    Route::post('/keranjang/add', [CartController::class, 'add']);
    Route::get('/keranjang', [CartController::class, 'index']);
    Route::post('/keranjang/update-qty', [CartController::class, 'updateQty']);

    Route::get('/metode-bayar', [OrderController::class, 'metode']);
    Route::post('/bayar/konfirmasi', [OrderController::class, 'store']);

    Route::get('/riwayat', [OrderController::class, 'riwayat']);
    Route::get('/status/{order}', [OrderController::class, 'status']);

    Route::get('/profil', [CustomerController::class, 'profil']);
    Route::post('/profil/update', [CustomerController::class, 'updateProfil']);

    Route::get('/logout', [CustomerController::class, 'logout']);
});

Route::get('/menunggu-bayar', function () {
    return view('menunggu-bayar');
});

// LOGIN ADMIN
Route::get('/admin/login', [AuthController::class, 'loginForm']);
Route::post('/admin/login', [AuthController::class, 'login']);

// ADMIN AREA (PROTECTED)
Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::get('/orders', [OrderAdminController::class, 'index']);
    Route::post('/orders/{order}/confirm', [OrderAdminController::class, 'confirm']);
    Route::post('/logout', [AuthController::class, 'logout']);
});