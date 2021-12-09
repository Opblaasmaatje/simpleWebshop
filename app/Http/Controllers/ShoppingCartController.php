<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has("cart")){
            return view("shoppingcart.shoppingcartView", ["products"=>null]);
        }
        $oldcart = session()->get("cart");
        $cart = new ShoppingCart($oldcart);
        // dd($cart);
        return view("shoppingcart.shoppingcartView", ["products" =>$cart->items, "totalPrice"=>$cart->totalPrice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()){
            $validated = $request->validate([
            'id' => 'required|integer',
        ]);
            $product = Product::find($validated["id"]);
            $oldcart = session()->has("cart") ? session()->get("cart") : null;
            $cart = new ShoppingCart($oldcart);
            $cart->add($product, $product->id);

            session()->put("cart", $cart);
            session()->flash("message", "Item has been added");
            return back();
        }else{
            session()->flash("message", "Please login first");
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $shoppingCart)
    {
        //
    }

    public function reduceByOne($id){
        if (Auth::check()){
            $oldcart = session()->has("cart") ? session()->get("cart") : null;
            $cart = new ShoppingCart($oldcart);
            $cart->reduceByOne($id);
            session()->put("cart", $cart);
            return back();
        }else{
            session()->flash("message", "Please login first");
            return back();
        }
    }
}
