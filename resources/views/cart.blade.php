
@extends('user_layout')
@section('content')
    <div class="container" style="margin-top: 5%;margin-bottom: 5%">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Cart</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="cart-container">
                                    <div class="cart-head">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Photo</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col" class="text-right">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cartData as $value)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td><img
                                                                src="{{ $value->getProductData->image }}"
                                                                class="img-fluid" width="35" alt="product"></td>
                                                        <td>{{ $value->getProductData->name }}</td>
                                                        <td>
                                                            <div class="form-group mb-0">
                                                                <input type="number" class="form-control cart-qty"
                                                                       name="cartQty1" id="cartQty1" value="{{ $value->quantity }}">
                                                            </div>
                                                        </td>
                                                        <td>₹ {{ !empty($value->getProductData->sale_price) ? $value->getProductData->sale_price : $value->getProductData->price }}</td>
                                                        <td class="text-right">₹ {{ !empty($value->getProductData->sale_price) ? ($value->getProductData->sale_price * $value->quantity) : ($value->getProductData->price * $value->quantity) }}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="cart-body">
                                        <div class="row">
                                            <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                <div class="order-note">
                                                        <!--                                                    <div class="form-group">-->
                                                        <!--                                                        <div class="input-group">-->
                                                        <!--                                                            <input type="search" class="form-control"-->
                                                        <!--                                                                   placeholder="Coupon Code" aria-label="Search"-->
                                                        <!--                                                                   aria-describedby="button-addonTags">-->
                                                        <!--                                                            <div class="input-group-append">-->
                                                        <!--                                                                <button class="input-group-text" type="submit"-->
                                                        <!--                                                                        id="button-addonTags">Apply-->
                                                        <!--                                                                </button>-->
                                                        <!--                                                            </div>-->
                                                        <!--                                                        </div>-->
                                                        <!--                                                    </div>-->
                                                        <div class="form-group">
                                                            <label for="specialNotes">Special Note for this
                                                                order:</label>
                                                            <textarea class="form-control" name="specialNotes"
                                                                      id="specialNotes" rows="3"
                                                                      placeholder="Message here">{{ $user->commentData->comment ?? null }}</textarea>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                <div class="order-total table-responsive ">
                                                    <table class="table table-borderless text-right">
                                                        <tbody>
                                                        <tr>
                                                            <td>Sub Total :</td>
                                                            <td>₹ {{ $subtotal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping :</td>
                                                            <td>₹ {{ $shipping }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tax({{ $tax }}%) :</td>
                                                            <td>₹ {{ $taxAmount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="f-w-7 font-18"><h4>Amount :</h4></td>
                                                            <td class="f-w-7 font-18"><h4>₹ {{ $total }}</h4></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-footer text-right">
                                        <button type="button" class="btn btn-outline-primary my-1" value="Update Cart">Update Cart</button>
                                        <a href="page-checkout.html" class="btn btn-outline-success my-1"><i
                                                class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                            &nbsp;Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    @endsection
