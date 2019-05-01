@extends('layouts.pages')

@section('content')
    <h2>Admin login</h2>
    <form method="post" action="{{ route('admin.login') }}">
        Email: <input name="email">
        Password: <input name="password">
        {{ csrf_field() }}
        <input type="submit" value="login">
    </form>
@endsection