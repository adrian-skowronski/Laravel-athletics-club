<?php

use Illuminate\Support\Facades\Schema;

//LISTA NAZW TABEL
$tables = ['trainings', 'events'];

//TŁUMACZENI NA POLSKI W TABLICY ASOCJACYJNEJ
$tableNames = [
    'trainings' => 'Treningi',
    'events' => 'Wydarzenia'
];
?>

@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel admina'])

<body>
@include('shared.navbar')
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
                @foreach($tables as $table)
                <tr>
                    <td>{{ $tableNames[$table] ?? $table }}</td>
                    <td>
                    <a href="{{ route('admin.table', ['table' => $table]) }}" class="btn btn-primary">Wyświetl</a>
                    </td>
                </tr>
                @endforeach
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
                    <th>Akcja</th>
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
                        <form action="{{ route('admin.reject', $user->user_id) }}" method="POST" style="display:inline;">
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
