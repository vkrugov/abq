<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', 'ProductController@getProducts');
Route::get('/genders', 'UserController@getGenders');
Route::get('/product-types', 'ProductController@getProductTypes');
Route::post('/cart/add', 'CartController@addToCart')->middleware('checkProduct');
Route::post('/cart/delete-item', 'CartController@deleteItem')->middleware('checkProduct');
Route::post('/cart/delete-items', 'CartController@deleteItems')->middleware('checkProduct');
Route::post('/cart/clear-cart', 'CartController@clearCart');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@registration')->middleware('checkApiRegister');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
