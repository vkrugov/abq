<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        if ($request->userId === null) {
            $a = 1;
        } else {
        Cart::create([
                'user_id' => $request->userId,
                'product_id' => $request->productId
            ]);
        }

        return 'Product added to Cart';
    }
}
