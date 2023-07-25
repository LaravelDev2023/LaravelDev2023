@extends('user_layout')
@section('content')
<div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h2 class="card-title text-center">Login</h2>
                    <form action="{{route('login')}}" method="POST" name="loginForm" enctype="multipart/from-data">
                        <hr>
                        @csrf
                        
                        <div class="form-group">
                            <label for="emailInput">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   required="required" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="passInput">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   required="required" placeholder="Password">
                        </div>
                        <br>
                        <center>
                            <input type="submit" name="loginbtn" class="btn btn-success" value="Login">
                            <input type="reset" class="btn btn-danger">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection