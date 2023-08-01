@extends('admin.layout')
@section('content')                    
                            <div class="card-body">
                                
                                <table id="datatablesSimple">
                                <a href="{{ route('product.create') }}" type="button" class="btn btn-primary" name="add_user">Add Product</a>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Color</th>
                                            <th>Manufactrur</th>
                                            <th>Product Code </th>
                                            <th>Gender</th>
                                            <th>Function</th>
                                            <th>Stock</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($all_products as $all_product)
                                        <tr>
                                            <td>{{$all_product->id}}</td>
                                            <td>{{$all_product->name}}</td>
                                            <td>{{$all_product->price}}</td>
                                            <td>{{$all_product->sale_price}}</td>
                                            <td>{{$all_product->color}}</td>
                                            <td>{{$all_product->brand_id}}</td>
                                            <td>{{$all_product->product_code}}</td>
                                            <td>{{$all_product->gender}}</td>
                                            <td>{{$all_product->function}}</td>
                                            <td>{{$all_product->stock}}</td>
                                            <td>{{$all_product->description}}</td>
                                            <td><img src="{{asset('profiles/products').'/'.$all_product->image}}" width="150" height="150"></td>
                                            <td>
                                            <a type="button" class="btn btn-success" href="{{ route('brands.edit',['brand' => $all_product->id])}}">Edit</a>
                                            <a type="button" class="btn btn-{{$all_product->is_active==1?'success':'danger'}}" href="{{ route('deactivate_brands',['id' => $all_product->id,'status'=>$all_product->is_active == 1 ? 0 : 1])}}">{{ $all_product->is_active == 1 ? 'Deactive' : 'Active' }}</a>


                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        

@endsection