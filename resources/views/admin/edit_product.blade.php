@extends('admin.layout')
@section('content')  


<div class="album py-5" style="height:120vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="max-width: 65rem;padding: 2%;">
                <h2> Add New Product</h2>
                <hr>
                @if ($errors->any())
                <div class="alert alert-danger">
                 <ul>
                  @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                  @endforeach
                </ul>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{route('product.update',['product' => $product->id])}}" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Meet"
                                       required="" value='{{$product->name}}'>
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Meet"
                                       required="" value='{{$product->price}}'>
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Sale Price</label>
                                <input type="text" class="form-control" id="price" name="sale_price" placeholder="Meet"
                                       required="" value='{{$product->sale_price}}'>
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Color</label>
                                <input type="text" class="form-control" id="price" name="color" placeholder="Meet"
                                       required="" value='{{$product->color}}'>
                            </div>       
                    </div>

                    <div class="col">
                                <label for="inputCountry" class="form-label">Manufactrur</label>
                                <select class="form-select" id="inputCountry" aria-label="Default select example"
                                        required="" name="brand_id">
                                    <option selected disabled>Select</option>
                                    @foreach($all_brand as $all_brands)
                                    <option value="{{ $all_brands->id }}" @if($product->brand_id == $all_brands->id){{'selected'}} @endif>{{ $all_brands->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Meet"
                                       required="" value='{{$product->product_code}}'>
                            </div>       
                    </div>
                    
                    <div class="row mb-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label><br>
                        <input type="radio" id="gender" name="gender" value="Male" @if($product->gender == 'Male'){{'checked'}} @endif>Male
                        <input type="radio" id="gender" name="gender" value="Female" @if($product->gender == 'Female'){{'checked'}} @endif>Female
                    </div>
                 </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Function</label>
                                <input type="text" class="form-control" id="function" name="function" placeholder="Meet"
                                       required="" value='{{$product->function}}'>
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Meet"
                                       required="" value='{{$product->stock}}'>
                            </div>       
                    </div>
                    <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"
                                          placeholder="address" required="" value='{{$product->description}}'>{{$product->description}}</textarea>
                            </div>
                    </div>
                    <div class="row mb-3"> 
                           <div class="col">
                                <label for="profile" class="form-label">Image</label><br>
                                <input type="file" class="form-control-file" name="image" id="image">
                                <img src="{{asset('profiles/products').'/'.$product->image}}" width="150" height="150">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="product" id="product" value=" Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection