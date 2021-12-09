<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("admin");
        $brands = Brand::get();
        return view("brand.brandView", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("admin");
        return view("brand.brandAdd");
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
        ]);

        $brand = new Brand();
        $brand->name = $validated["name"];
        $brand->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $this->authorize("admin");
        return view("brand.brandShow", with($brand));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $this->authorize("admin");
        return view("brand.brandEdit", with($brand));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {

        $this->authorize("admin");
        $validated = $request->validate([
            'name' => 'required|string',
            'id' => 'required|integer',
        ]);

        Brand::where('id',$validated["id"])->update(['name'=>$validated["name"]]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->authorize("admin");
        Brand::destroy($brand->id);
        return redirect()->route("brand.index");
    }
}
