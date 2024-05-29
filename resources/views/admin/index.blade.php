<?php

use Illuminate\Support\Facades\Schema;

//LISTA NAZW TABEL
$tables = ['trainings', 'events'];

?>

@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel admina'])

<body>
@include('shared.navbar')
<br><br>
<section id="oferta">
    <div class="container">
      <br>
        <h1>Lista tabel w bazie danych</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa tabeli</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $table)
                <tr>
                    <td>{{ $table }}</td>
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
<br>
<br>
@include('shared.footer')
</body>
</html>
