@extends('admin.layout')
@section('content')  


<div class="album py-5" style="height:120vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card border-success" style="max-width: 65rem;padding: 2%;">
                <h2> Add New Brands</h2>
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
                    <form method="POST" action="{{route('brands.store')}}" enctype="multipart/form-data">
                     @csrf
                     @method('POST')   
                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Meet"
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
                            <input type="submit" name="brand" id="brand" value="Add Brand" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection