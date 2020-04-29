<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['user_id', 'product_id'];

    public $user_id;
    public $product_id;

    public $timestamps = false;

    public static function addProducts($products) {
        foreach ($products as $product) {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product
            ]);
        }
    }
}
