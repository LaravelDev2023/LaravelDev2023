<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_brands = Brands::all();
        return view('admin.all_brands_list', compact('all_brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.add_brands');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:5|max:10|string',
            'description' => 'nullable|string|max:100',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $req=$request->except(['_token', 'brand']);
        $imageName = 'lv'.rand().'.'.$request->image->extension();
        $request->image->move(public_path('profiles/brands'),$imageName);
        $req['image'] = $imageName;
        $requestData = Brands::create($req);
        
        
        return redirect()->route('brands.index')->with('success','Brand Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brand)
    {
        //
       
        //$all_brands = Brands::all();
        return view('admin.edit_brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brands $brand)
    {
        //
       $this->validate($request,[
         'name' =>'required|min:5|max:10|string',
         'description' => 'nullable|string|max:100',
         'image' => 'required|mimes:jpg,jpeg,png'
       ]);
       $req=$request->except(['_token', 'brand']);
       $imageName = 'lv'.rand().'.'.$request->image->extension();
       $request->image->move(public_path('profiles/brands'),$imageName);
       $req['image'] = $imageName;
       $brand=Brands::find($brand->id);
       $brand->update($req);
       return redirect()->route('brands.index')->with('success','Brand Added successfully!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brands)
    {
        //
    }

    public function deactivateBrandsByAdmin(Request $request, $id, $status=1){
   
       $brands=Brands::find($id);
       if(!empty($brands)){
        $brands->is_active = $status;
        $brands->save();
        return redirect()->route('brands.index');
       }
    }
}
