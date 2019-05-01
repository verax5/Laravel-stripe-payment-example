<!doctype html>
<html lang="en">
<head>
    <title> @yield('title') </title>
</head>

    <body>
        <div style="text-align:center; margin-bottom:20px;">
            <a href="{{ route('home') }}">
                <img class="img-fluid" src="{{ asset('logo.png') }}">
            </a>
        </div>

        @yield('content')
    </body>

</html>