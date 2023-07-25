@extends('admin.layout')
@section('content')                    
                            <div class="card-body">
                                
                                <table id="datatablesSimple">
                                <a href="{{ route('add_user') }}" type="button" class="btn btn-primary" name="add_user">Add User</a>
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Adderess</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($all_user as $users)
                                        <tr>
                                            <td>{{$users->full_name}}</td> 
                                            <td>{{$users->role_name}}</td>
                                            <td>{{$users->email}}</td>
                                            <td>{{$users->contact}}</td>
                                            <td>{{$users->adderess}}</td>
                                            <td>{{$users->countryData->name}}</td>
                                            <td>
                                            <a type="button" class="btn btn-success" href="{{ route('edit_user',$users->id)}}">Edit</a>
                                            <a type="button" class="btn btn-{{$users->is_active==1?'success':'danger'}}" href="{{ route('deactivate_user',['id' => $users->id,'status'=>$users->is_active == 1 ? 0 : 1])}}">{{ $users->is_active == 1 ? 'Deactive' : 'Active' }}</a>


                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        

@endsection