<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class HomePageIndex extends Controller
{
    //
    public function index(Request $request){
        $start_date = Carbon::now()->firstOfMonth();
        $end_date = Carbon::now()->lastOfMonth();
        $product_data = Product::whereBetween('created_at',[$start_date,$end_date])->inRandomOrder()->limit(8)->get();
        return view('user_mainpage',compact('product_data'));
        
    }
}
