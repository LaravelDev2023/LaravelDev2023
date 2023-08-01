<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_products = Product::all();
        return view('admin.all_product_list', compact('all_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $all_brand = Brands::all();
        return view('admin.add_product',compact('all_brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required|min:5|string',
            'price' => 'required|float',
            'sale_price' => 'required|float',
            'color' => 'required',
            'brand' => 'required',
            'product_code' => 'required',
            'gender' => 'required',
            'function' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $req=$request->except(['_token', 'regist']);
        $imageName = 'lv'.rand().'.'.$request->image->extension();
        $request->image->move(public_path('products/products'),$imageName);
        $req['image'] = $imageName;
       
        $requestData = Products::create($req);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
