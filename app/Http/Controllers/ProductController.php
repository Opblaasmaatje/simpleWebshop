<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view("product.productView", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("admin");
        $brands = Brand::get();
        return view("product.productAdd", with(compact("brands")));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("admin");
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'image'=>'nullable|mimes:jpeg,jpg,png',
            'description'=>'required|string',
            'brand'=>'required|integer',
        ]);
        $product = new Product();
        $product->name = $validated["name"];
        $product->price = $validated["price"];
        $product->brand_id = $validated["brand"];
        $product->image = Image::make($validated["image"])->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('data-url');;
        $product->description = $validated["description"];
        $product->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $brand = Brand::where("id", "=", $product->id)->first();
        return view("product.productShow", with(compact("product", "brand")));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize("admin");
        $brands = Brand::get();
        return view("product.productEdit", with(compact("product", "brands")));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize("admin");
        $validated = $request->validate([
            'name' => 'required|string',
            'id' => 'required|integer',
            'price' => 'required|integer',
            'image'=>'nullable|mimes:jpeg,jpg,png',
            'description'=>'required|string',
            'brand'=>'required|integer',
        ]);
        $validated["image"] = Image::make($validated["image"])->resize(15, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('data-url');

        Product::where('id',$validated["id"])->update(['name'=>$validated["name"], "price"=>$validated["price"],
        "brand_id"=>$validated["brand"],"description"=> $validated["description"], "image"=>$validated["image"]]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize("admin");
        Product::destroy($product->id);
        return redirect()->route('product.index');
    }
}
