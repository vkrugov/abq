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
}
