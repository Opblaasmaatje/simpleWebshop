<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\OrderdProduct;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin){
            $invoices = Invoice::with("orderedProduct", "user")->get();
            $orderedProducts = OrderdProduct::with("invoice", "product")->get();
            return view("invoice.invoiceView")->with(compact("invoices", "orderedProducts"));
        }else{
            $invoices = Invoice::with("orderedProduct", "user")->where("user_id", "=", auth()->user()->id)->get();
            $orderedProducts = OrderdProduct::with("invoice", "product")->get();
            return view("invoice.invoiceView")->with(compact("invoices", "orderedProducts"));
        }

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
    public function store()
    {
        $oldcart = session()->has("cart") ? session()->get("cart") : null;
        $cart = new ShoppingCart($oldcart);
        $invoice = new Invoice();
        $invoice->user_id = auth()->user()->id;
        $invoice->totalPrice = $cart->totalPrice;
        $invoice->save();
        foreach($cart->items as $item){
            $OrderdProduct = new OrderdProduct();
            $test = $item["item"]["id"];
            $OrderdProduct->product_id = $test;
            $OrderdProduct->invoice_id = $invoice->id;
            $OrderdProduct->amount = $item["qty"];
            $OrderdProduct->save();
        }
        session()->flash("message", "Order has been created with number: ". $invoice->id);
        return back();
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with("user", "orderedProduct")->find($id);
        $orderedProducts = OrderdProduct::with("invoice", "product")->get();
        if(auth()->user()->isAdmin || auth()->user()->id == $invoice->user_id){
            return view("invoice.invoiceShow")->with(compact("invoice", "orderedProducts"));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
