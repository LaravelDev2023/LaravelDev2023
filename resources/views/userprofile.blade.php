@extends('user_layout')
@section('content')

<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<img src="{{asset('profiles').'/'.$user->profile}}">
				</div>
				
			</div>

			<form method="POST" action="{{route('user_profile_image_update')}}" enctype="multipart/form-data">
                     @csrf
			<div class="user-profile">
			<div class="row mb-3">
                        
						<div class="col">
                            </br>
							<input type="file" class="form-control-file" name="profile" id="profile">
						</div>
			</div>
			<div class="mb-3">
                            <input type="submit" name="regist" id="regist" value="Update Image" class="btn btn-primary">
                        </div>	
			</div>
        </form>
			
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
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
                    <form method="POST" action="{{route('user_profile_update')}}" enctype="multipart/form-data">
                     @csrf    
					 
                    <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" value="{{ $user->fname }}" class="form-control" id="fname" name="fname" placeholder="Meet"
                                       required="">
                            </div>
                            <div class="col">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text"  value="{{ $user->lname }}" class="form-control" id="lname" name="lname" placeholder="Shah"
                                       required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="name@example.com" required=""  value="{{ $user->email }}">
                            </div>
                            <div class="col">
                                <label for="mobile" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="mobile" name="contact"
                                       placeholder="1234567890" required="" value="{{ $user->contact }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col">
                                <label for="mobile" class="form-label">Password</label>
                                <input type="password" class="form-control" id="mobile" name="password"
                                       placeholder="" required="">
                            </div>
                            <div class="col">
                                <label for="gender" class="form-label">Gender</label><br>
                                <input type="radio" id="gender" name="gender" value="Male" @if($user->gender == 'Male') {{'checked'}} @endif >Male
                                <input type="radio" id="gender" name="gender" value="Female" @if($user->gender == 'Female') {{'checked'}} @endif>Female
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                        <!-- <div class="col">
                                <label for="hobbies" class="form-label">Hobbies</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                           name="hobbies[]" value="Travelling">
                                    <label class="form-check-label" for="inlineCheckbox1">Travelling</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                           name="hobbies[]" value="Music">
                                    <label class="form-check-label" for="inlineCheckbox2">Music</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                           name="hobbies[]" value="Coding">
                                    <label class="form-check-label" for="inlineCheckbox3">Coding</label>
                                </div>
                            </div> -->
                            <div class="col">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" name="adderess"
                                          placeholder="address" required="">{{ $user->adderess }}</textarea>
                            </div>
                            <div class="col">
                                <label for="inputCountry" class="form-label">Country</label>
                                <select class="form-select" id="inputCountry" aria-label="Default select example"
                                        required="" name="country">
                                    <option selected disabled>Select</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @if($user->country == $country->id){{'selected'}} @endif>{{ $country->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            
                            
                        </div>
                        <div class="row mb-3">
                        
                            <div class="col">
                                <label for="profile" class="form-label">Profile</label><br>
                                <input type="file" class="form-control-file" name="profile" id="profile" value="{{ $user->profile }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="regist" id="regist" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
</div>
</div>
</div>
</div>

@endsection


