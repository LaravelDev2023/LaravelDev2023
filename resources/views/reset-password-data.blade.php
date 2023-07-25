@extends('user_layout')
@section('content')

<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png"  width="180" class="img-thumbnail logo img-circle">
                    <div>
                        <h3 class="text-center">Reset Your password</h3>
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
                    </div>
                    <div class="panel-body">
                        <form action="{{route('reset-password-data')}}" method="post">
                            @csrf
                        <fieldset>
                            <div class="form-group">
                            <input class="form-control input-lg" name="email" type="hidden" value={{$email}}>
                            </div>
                            <div class="form-group">
                            <input class="form-control input-lg" placeholder="Reset Password" name="resetpass" type="password">
                            </div>
                            <div class="form-group">
                            <input class="form-control input-lg" placeholder="Confirm Password" name="cnfirm_resetpassl" type="password">
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