@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Trenera'])

<body>
    @include('shared.navbar')
    
    <div class="container mt-5">
    <div class="user-info mb-5">
            <h1>Twoje Dane</h1>
            <ul>
                <li><strong>Imię:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Nazwisko:</strong> {{ Auth::user()->surname }}</li>
                <li><strong>Data urodzenia:</strong> {{ Auth::user()->birthdate }} (wiek: {{ $age }} l.)</li>
                <li><strong>Telefon:</strong> {{ Auth::user()->phone }}</li>
                <li><strong>Zdjęcie:</strong> 
                <br>
                    @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" style="max-width: 250px; max-height: 250px;">
                    @else
                        Brak zdjęcia
                    @endif
                </li>
            </ul>

            <div class="container">
                <a href="{{ route('trainer.edit') }}" class="btn btn-primary">Edytuj Dane</a>
            </div>
        </div>
        <h1>Twoje Treningi</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Opis</th>
                    <th>Data</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->date }}</td>
                    <td>
                        <a href="{{ route('trainer.viewParticipants', $training->training_id) }}" class="btn btn-primary">Pokaż uczestników</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $trainings->links('pagination::bootstrap-4') }}
            </div>
    </div>
    @include('shared.footer')
</body>
</html>
