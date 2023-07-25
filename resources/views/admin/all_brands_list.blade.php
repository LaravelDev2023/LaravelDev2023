@extends('admin.layout')
@section('content')                    
                            <div class="card-body">
                                
                                <table id="datatablesSimple">
                                <a href="{{ route('brands.create') }}" type="button" class="btn btn-primary" name="add_user">Add Brand</a>
                                    <thead>
                                        <tr>
                                            <th>Brand Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($all_brands as $all_brand)
                                        <tr>
                                            <td>{{$all_brand->id}}</td>
                                            <td>{{$all_brand->name}}</td>
                                            <td>{{$all_brand->description}}</td>
                                            <td><img src="{{asset('profiles/brands').'/'.$all_brand->image}}" width="150" height="150"></td>
                                            <td>
                                            <a type="button" class="btn btn-success" href="{{ route('brands.edit',['brand' => $all_brand->id])}}">Edit</a>
                                            <a type="button" class="btn btn-{{$all_brand->is_active==1?'success':'danger'}}" href="{{ route('deactivate_brands',['id' => $all_brand->id,'status'=>$all_brand->is_active == 1 ? 0 : 1])}}">{{ $all_brand->is_active == 1 ? 'Deactive' : 'Active' }}</a>


                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        

@endsection