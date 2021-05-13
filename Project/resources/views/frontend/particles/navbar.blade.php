<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Test Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home')}}">Home </a>
                </li>


                @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login')}}">Login</a>
                </li>
                @endif

            </ul>

        </div>
    </nav>

</div>
