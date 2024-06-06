{{-- athlete.panel --}}
@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Sportowca'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">

    <div class="user-info mb-5">
            <h2>Twoje Dane</h2>
            <ul>
                <li><strong>Imię:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Nazwisko:</strong> {{ Auth::user()->surname }}</li>
                <li><strong>Data urodzenia:</strong> {{ Auth::user()->birthdate }}</li>
                <li><strong>Telefon:</strong> {{ Auth::user()->phone }}</li>
                <li><strong>Zdjęcie:</strong> 
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo">
                    @else
                        Brak zdjęcia
                    @endif
                </li>
            </ul>

            <div class="container">
        <a href="{{ route('athlete.edit') }}" class="btn btn-primary">Edytuj Dane</a>
    </div>
        </div>

        <h2>Twoje Treningi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($training->date)->isPast() ? 'Archiwalna' : 'Przyszłe' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">Twoje Zawody</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->isPast() ? 'Archiwalna' : 'Przyszłe' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('shared.footer')
</body>
