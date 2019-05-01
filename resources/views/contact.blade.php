@extends('layouts.pages')

@section('title', 'Contact us')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form method="POST" action="{{ route('contact') }}">
                <div class="form-group">
                    <label for="username"><b>Name</b></label>
                    <input data-validation="required" id="username" class="form-control" type="text" name="username" value="@if(auth()->guard('user')->check()){{auth()->guard('user')->user()->username}} @endif" @if(auth()->guard('user')->check()) disabled @endif>
                </div>

                <div class="form-group">
                    <label for="email"><b>Email address</b></label>
                    <input data-validation="email" id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Email we should contact you on..">
                </div>

                <div class="form-group">
                    <label for="message"><b>Message</b></label>
                    <textarea data-validation="required" id="message" class="form-control" name="message" rows="5" placeholder="How can we help you?">{{ old('message') }}</textarea>
                </div>

                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
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