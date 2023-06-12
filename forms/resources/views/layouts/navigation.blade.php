<nav x-data="{ open: false }">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">XFORMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    @if (auth()->user()->role?->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('forms') }}">Forms</a>
                        </li>
                    @endif
                </ul>
                <form action="{{ url('logout') }}" method="post">
                    @csrf
                    <div class="dropdown dropstart">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start">
                            <li><button type="submit" class="dropdown-item">Logout</button></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</nav>
