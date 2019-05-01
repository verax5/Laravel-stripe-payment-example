@extends('layouts.pages')

@section('content')
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 login-box">
            <h2 class="login-box-heading">Member login</h2>
            <form method="post" action="{{ route('user.login') }}">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" name="username" data-validation="required">
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="email" name="password" data-validation="required">
                </div>

                {{ csrf_field() }}
                <button class="btn btn-primary user-login-button" type="submit" value="login">Login</button>
            </form>

            <br>
            <p>
                No account? <a href="{{ route('user.register') }}">Register Here</a>
            </p>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $.validate({
               lang: 'en'
            });
        });
    </script>
@endsection