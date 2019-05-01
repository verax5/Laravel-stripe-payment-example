@extends('layouts.mail')

@section('content')
    <div class="container" style="width:600px; margin:auto;">
        Hi, {{ $data->username }}
    </div>
@endsection