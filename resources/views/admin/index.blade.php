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
<section id="oferta">
    <div class="container mt-3">
        <h1>Zarządzanie zasobami aplikacji</h1>
        <table class="table mt-5">
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

@include('shared.footer')
</body>
</html>
