<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        $user = auth()->user();

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->productId
        ]);

        $cartProducts = Cart::where('user_id', $user->id)->pluck('product_id')->toarray();

        return response()->json($cartProducts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request)
    {
        $user = auth()->user();

        Cart::where([['product_id' => $request->productId], ['user_id' => $user->id]])->first()->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItems(Request $request)
    {
        $user = auth()->user();

        Cart::where([['product_id' => $request->productId], ['user_id' => $user->id]])->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCart(Request $request)
    {
        $user = auth()->user();

        Cart::where('user_id', $user->id)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
