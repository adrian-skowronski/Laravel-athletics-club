<style>
    .navbar {
      background-color: #0077b6 !important; 
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: white !important; 
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('start.index') }}"> <b>Klub Sokół</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="btn btn-link nav-link" href="{{ route('admin.index') }}">Panel Admina</a>
                        </li>
                    @elseif(auth()->user()->isCoach())
                        <li class="nav-item">
                            <a class="btn btn-link nav-link" href="{{ route('trainer.index') }}">Panel Trenera</a>
                        </li>
                        @elseif(auth()->user()->isAthlete())

                        <li class="nav-item">
                            <a class="btn btn-link nav-link" href="{{ route('athlete.panel') }}">Panel Sportowca</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Wyloguj się</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-link nav-link" href="{{ route('login') }}">Zaloguj się</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-link nav-link" href="{{ route('register') }}">Zarejestruj się</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

