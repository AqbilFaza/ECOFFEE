<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;

Route::get('/', [CustomerController::class, 'form']);
Route::post('/customer/store', [CustomerController::class, 'store']);

Route::get('/home', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'detail']);

Route::post('/cart/add', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'index']);
