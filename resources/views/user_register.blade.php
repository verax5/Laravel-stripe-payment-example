@extends('layouts.pages')

@section('content')
    <br>
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6 register-box">
            <h2 class="register-box-heading">Quick Registration</h2>

            <form method="post" action="{{ route('user.register') }}">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" name="username" data-validation="required">
                </div>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" data-validation="email" data-validation="required">
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" data-validation="length" data-validation-length="min5" type="password">
                </div>

                {{ csrf_field() }}
                <button class="btn btn-primary register-box-button" type="submit" value="register">Register</button>
            </form>

            <br>
            <p>
                Already have an account?<a href="{{ route('user.login') }}"> Login Here</a>.
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