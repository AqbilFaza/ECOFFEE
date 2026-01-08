<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        // jika customer belum isi data
        if (!session()->has('customer_id')) {
            return redirect('/');
        }

        return $next($request);
    }
}