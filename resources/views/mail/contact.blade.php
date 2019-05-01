@extends('layouts.mail')

@section('content')
    <div style="width:600px; margin:auto;">
        <h5>User has contacted you..</h5>

        <p style="padding:0; margin:0;"><b>Name:</b> {{ $data['username'] }}</p>
        <p style="padding:0; margin:0;"><b>Email:</b> {{ $data['email'] }}</p>


        <p> {{ $data['message'] }}</p>
    </div>
@endsection
