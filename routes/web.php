<?php

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get("/reduce/{id}", [ShoppingCartController::class, "reduceByOne"])->name("shoppingcart.reduce");

Route::resource('/home', HomeController::class);
Route::resource('/invoice', InvoiceController::class);
Route::resource('/brand', BrandController::class)->except("show");
Route::resource('/product', ProductController::class);
Route::resource('/shoppingcart', ShoppingCartController::class);
Route::resource('/invoice', InvoiceController::class);
Route::put('/product/store', [ProductController::class, "store"]);
