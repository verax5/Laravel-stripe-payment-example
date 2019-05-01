<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('members.products') }}">Members</a>
            </li>

            <li class="nav-item">
                <a class="nav-link subscribe-link" href="{{ route('subscriber.area') }}">Subscribers area  </a>
            </li>

            @if(auth()->guard('user')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.login') }}">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.register') }}">Register</a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
            </li>

        </ul>
    </div>
</nav>