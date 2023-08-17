<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Lineitem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
        $subtotal = 0;
        $shipping = 10;
        $tax = 10; //in percentage
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            $subtotal += $price * $value->quantity;
        }
        $taxAmount = round(($subtotal * $tax) / 100);
        $total = round($subtotal + $shipping + $taxAmount);
        return view('cart', compact('cartData', 'user', 'subtotal', 'shipping', 'tax', 'total', 'taxAmount'));
    }

    public function store(Request $request)
    {
        $requestData = $request->except('_token');
        foreach ($requestData['cart'] as $key => $value) {
            if ($requestData['cartQty'][$key] < 1) {
                Cart::where('id', $value)->delete();
            } else {
                Cart::where('id', $value)->update(['quantity' => $requestData['cartQty'][$key] ?? 1]);
            }
        }
        Comment::where('user_id', auth()->user()->id)->update(['comment' => $requestData['specialNotes']]);
        return redirect()->back()->with('success', 'Cart has been updated!');
    }

    public function storeOrder(Request $request)
    {
        $requestData = $request->all();
        $user = auth()->user();
        $cartData = Cart::with('getProductData')->where('user_id', $user->id)->get();
        $commentData = Comment::where('user_id', auth()->user()->id)->value('comment');
        $subtotal = 0;
        $shipping = 10;
        $tax = 10; //in percentage
        $lineItemData = [];
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            $subtotal += $price * $value->quantity;
        }
        $taxAmount = round(($subtotal * $tax) / 100);
        $total = round($subtotal + $shipping + $taxAmount);
        $orderData = Order::create([
            'user_id' => $user->id,
            'sub_total' => $subtotal ?? 0,
            'shipping' => $shipping ?? 0,
            'tax_amount' => $taxAmount ?? 0,
            'tax_rate' => $tax ?? 0,
            'amount' => $total ?? 0,
            'comment' => $commentData ?? null,
            'status' => 'Order Placed',
        ]);
        foreach ($cartData as $value) {
            $productData = $value->getProductData;
            $price = !empty($productData->sale_price) ? $productData->sale_price : $productData->price;
            Lineitem::create([
                'user_id' => $user->id,
                'order_id' => $orderData->id,
                'product_id' => $productData->id,
                'quantity' => $value->quantity ?? 0,
                'price' => $price ?? 0,
                'total_price' => $price * $value->quantity ?? 0,
            ]);
        }
        Cart::where('user_id', $user->id)->delete();
        Comment::where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'Your order has been placed successfully!');
    }

    public function addToCart(Request $request)
    {
        $requestData = $request->except('_token');
        $requestData['user_id'] = auth()->user()->id;
        Cart::create($requestData);
        return redirect()->route('cart.index')->with('success', 'Product added successfully!');
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
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
