<?php

namespace App\Http\Middleware\api;

use App\Product;
use Closure;

class CheckProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Product::findOrFail($request->productId);

        return $next($request);
    }
}
