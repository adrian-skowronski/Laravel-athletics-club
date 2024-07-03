@include('shared.html')
@include('shared.head', ['pageTitle' => 'Dane trenera'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 text-center">
        <h2 class="mb-4">Dane trenera</h2>
        <ul class="list-unstyled">
            <li class="mb-2"><strong>Imię i nazwisko:</strong> {{ $trainer->name }} {{ $trainer->surname }}</li>
            <li class="mb-2"><strong>Sport:</strong> {{ $trainer->sport->name }}</li>
            <li class="mb-2"><strong>Data urodzenia:</strong> {{ $trainer->birthdate }}</li>
            <li class="mb-2"><strong>Telefon:</strong> {{ $trainer->phone }}</li>
            <li class="mb-2">
                <strong>Zdjęcie:</strong><br>
                <div class="col-sm">
    @if(($trainer)->photo)
        <img src="{{ asset('storage/' . $trainer->photo) }}" alt="User Photo" class="user-photo">
    @else
        <div class="mt-5">
            <i>Brak wgranego zdjęcia trenera.</i>
        </div>
    @endif
</div>
            </li>
        </ul>

        <div class="mt-5">
            <a href="{{ route('trainings.view') }}" class="btn btn-secondary">Powróć do listy treningów</a>
        </div>
    </div>

    @include('shared.footer')
</body>
