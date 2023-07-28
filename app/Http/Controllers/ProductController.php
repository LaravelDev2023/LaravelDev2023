<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brands;
use Illuminate\Http\Request;

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
        $data =  $request->all();
        echo"<pre>"; print_r($data); exit;
        $this->validate($request,[
            'name' => 'required|min:5|max:10|string',
            'price' => 'required|float',
            'brand' => 'required|email|unique:users,email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'adderess' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        
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
