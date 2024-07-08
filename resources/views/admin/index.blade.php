<?php

use Illuminate\Support\Facades\Schema;

?>

@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel admina'])

<body>
@include('shared.navbar')
<div class="container mt-3">
@include('shared.session-error')
@include('shared.validation-error')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
<section id="zasoby">
    <div class="container mt-3">
        <h1>Zarządzanie zasobami aplikacji</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Zasób</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Użytkownicy</td>
                    <td>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Przejdź do zasobu</a>
                    </td>
                </tr>
                <tr>
                    <td>Treningi</td>
                    <td>
                        <a href="{{ route('trainings.index') }}" class="btn btn-primary">Przejdź do zasobu</a>
                    </td>
                </tr>
                <tr>
                    <td>Wydarzenia i zapisywanie sportowców</td>
                    <td>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">Przejdź do zasobu</a>
                    </td>
                </tr>
                <tr>
                    <td>Sporty</td>
                    <td>
                        <a href="{{ route('sports.index') }}" class="btn btn-primary">Przejdź do zasobu</a>
                    </td>
                </tr>
                <tr>
                    <td>Uczestnicy wydarzeń</td>
                    <td>
                        <a href="{{ route('event-user.index') }}" class="btn btn-primary">Przejdź do zasobu</a>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </table>

        
    </div>
</section>



<div class="container mt-5">
    <h1 class="mb-3">Prośby o rejestrację</h1>
    @if($users->isEmpty())
        <p>Brak próśb o rejestrację.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Data urodzenia</th>
                    <th>Zatwierdź</th>
                    <th>Odrzuć</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td>
                
                        <a href="{{ route('admin.approve', $user->user_id) }}" class="btn btn-success">Zatwierdź</a>
</td>
<td>
                        <form action="{{ route('admin.reject', $user->user_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Odrzuć</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@include('shared.footer')
</body>
</html>
