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
                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                     @csrf
                     @method('POST')   
                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Meet"
                                       required="">
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Meet"
                                       required="">
                            </div>       
                    </div>

                    <div class="col">
                                <label for="inputCountry" class="form-label">Manufactrur</label>
                                <select class="form-select" id="inputCountry" aria-label="Default select example"
                                        required="" name="brand">
                                    <option selected disabled>Select</option>
                                    @foreach($all_brand as $all_brands)
                                    <option value="{{ $all_brands->id }}">{{ $all_brands->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Meet"
                                       required="">
                            </div>       
                    </div>
                    
                    <div class="row mb-3">
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label><br>
                        <input type="radio" id="gender" name="gender" value="Male" checked>Male
                        <input type="radio" id="gender" name="gender" value="Female">Female
                    </div>
                 </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Function</label>
                                <input type="text" class="form-control" id="function" name="function" placeholder="Meet"
                                       required="">
                            </div>       
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="Meet"
                                       required="">
                            </div>       
                    </div>
                    <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"
                                          placeholder="address" required=""></textarea>
                            </div>
                    </div>
                    <div class="row mb-3"> 
                           <div class="col">
                                <label for="profile" class="form-label">Image</label><br>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="product" id="product" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection