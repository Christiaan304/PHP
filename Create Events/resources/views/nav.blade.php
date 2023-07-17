<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('event.index') }}">Eventos</a>
                </li>

                @auth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto me-5">

                @auth
                    <form id="search" class="d-flex me-5" role="search" action="{{ route('event.index') }}"
                        method="GET">
                        <input class="form-control me-2" type="search" id="search_event" name="search_event"
                            placeholder="Procurar Evento" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Procurar</button>
                    </form>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu">
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item ms-5">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Entrar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Cadastrar</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
