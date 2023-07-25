@extends('user_layout')
@section('content')

<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png"  width="180" class="img-thumbnail logo img-circle">
                    <div>
                        <h3 class="text-center">Forgot password?</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('resetpassword')}}" method="post">
                            @csrf
                        <fieldset>
                            <div class="form-group">
                            <input class="form-control input-lg" placeholder="E-mail Address" name="email" type="text">
                            </div>
                            <input class="btn btn-lg btn-primary btn-block" value="SEND ME PASSWORD" type="submit" name="submit">
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection