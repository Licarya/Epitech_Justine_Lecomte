<nav class="navbar navbar-expand-md navbar-dark bg-primary justify-content-center">
    <a class="navbar-brand abs" href="{{route('/')}}">Agence JA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="collapsingNavbar">

        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link nav-p-top" href="{{Route('/')}}">
                    Find a job
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                @if (session('role') == 0)
                    @auth
                        <span class="btn btn-warning">Admin</span>
                    @endauth
                @elseif (session('role') == 1)
                    @auth
                        <span class="btn btn-success">Auth U</span>
                    @endauth
                @elseif (session('role') == 2)
                    @auth
                        <span class="btn btn-info">Auth C</span>
                    @endauth
                @endif
                @guest
                    <span class="btn btn-danger">Guest</span>
                @endguest
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Personal space
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    @guest
                        <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                        <li><a class="dropdown-item" href="{{route('users.create')}}">Register</a></li>
                    @endguest
                    @if (session('role') == 0)
                        @auth
                        <li><a class="dropdown-item" href="{{route('admin.users.index')}}">Dashboard Admin</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        @endauth
                    @else
                        @auth
                            <li><a class="dropdown-item" href="{{route('users.show', Session::get('id'))}}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        @endauth
                    @endif
                </ul>
            </li>

        </ul>
    </div>
</nav>
