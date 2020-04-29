<?php

namespace App\Http\Controllers;

use App\Enums\ProductEnum;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProducts()
    {
        return Product::all();
    }

    public function getProductTypes()
    {
        return response()->json(ProductEnum::toSelectArray());
    }
}
