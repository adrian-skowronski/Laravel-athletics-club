@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Trenera'])

<body>
    @include('shared.navbar')
    
    <div class="container mt-5">
    <div class="user-info col-sm mb-5">
        <div class="row">
        <div class="col-sm">
            <h1>Twoje Dane</h1>
            <ul>
                <li><strong>Imię:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Nazwisko:</strong> {{ Auth::user()->surname }}</li>
                <li><strong>Data urodzenia:</strong> {{ Auth::user()->birthdate }} (wiek: {{ $age }} l.)</li>
                <li><strong>Telefon:</strong> {{ Auth::user()->phone }}</li>
                <li><strong>Sport:</strong> {{ Auth::user()->sport->name }}</li>
            </ul>
            

            <div class="container">
            <a href="{{ route('trainer.edit') }}" class="btn btn-primary">Edytuj dane</a>
            </div>
                </div>
                
                <div class="col-sm">
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" style="max-width: 250px; max-height: 250px;">
                    @else
                        <div class="mt-5">
                        <i>Brak wgranego zdjęcia użytkownika.</i>
                        </div>
                    @endif
</div>
<div class="col-sm"></div>
</div>
<div class="mt-5">
        <h1>Twoje Treningi</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Opis</th>
                    <th>Data</th>
                    <th scope="col">Od</th>
                    <th scope="col">Do</th>
                    <th scope="col">Sport</th>
                    <th scope="col">Max. pkt</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->date }}</td>
                    <td>{{ $training->start_time }}</td>
                    <td>{{ $training->end_time }}</td>
                    <td>{{ $training->trainer->sport->name }}</td>
                    <td>{{ $training->max_points }}</td>
                    <td>
                        <a href="{{ route('trainer.viewParticipants', $training->training_id) }}" class="btn btn-primary">Pokaż uczestników</a>
                        <a href="{{ route('trainer.editTraining', $training->training_id) }}" class="btn btn-warning">Edycja</a>
                                <form method="POST" action="{{ route('trainer.trainingDestroy', $training->training_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $trainings->links('pagination::bootstrap-4') }}
            </div>

            <div class="container mt-2 mb-3">
<div class="row">
    <div class="col">
    <a href="{{ route('trainer.createTraining') }}" class="btn btn-primary ">Dodaj trening </a>
</div>
</div>
    </div>
</div>
</div>
</div>
    @include('shared.footer')
</body>
</html>
