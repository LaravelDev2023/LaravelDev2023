@extends('user_layout')
@section('content')
<!-- Section-->
<section class="py-5">
<div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($product_data as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            @if(!empty($product->sale_price) && $product->stock != 0)
                                <div class="badge bg-dark text-white position-absolute"
                                     style="top: 0.5rem; right: 0.5rem"> Sale
                                </div>
                            @elseif($product->stock == 0)
                                <div class="badge bg-danger text-white position-absolute"
                                     style="top: 0.5rem; right: 0.5rem"> Out Of Stock
                                </div>
                        @endif
                        <!-- Product image-->
                            <img class="card-img-top" src="{{ $product->image }}" alt="Product Image"/>
                        {{--                            <img class="card-img-top" src="{{ url('/products') . '/' . $product->img }}" alt="Product Image"/>--}}
                        <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                    <!-- Product price-->
                                    @if(!empty($product->sale_price))
                                        <span
                                            class="text-muted text-decoration-line-through">{{ '₹' . $product->price }}</span>
                                        {{ '₹' . $product->sale_price }}
                                    @else
                                        {{ '₹' . $product->price }}
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                            href="{{ route('product_info', ['product' => $product->product_code]) }}">View
                                        Product</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a href="{{ route('product_list') }}" class="btn btn-outline-dark">View All</a>
                </div>

            </div>
        </div>
        </section>
        @endsection