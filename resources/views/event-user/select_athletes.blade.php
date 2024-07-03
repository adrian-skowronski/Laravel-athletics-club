@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zawodnicy spełniający wymagania'])

<body>
    @include('shared.navbar')
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
    @include('shared.session-error')
    @include('shared.validation-error')
    <h1 class="mb-3">Zapisz sportowców na wydarzenia</h1>

       
        <h3>Wybrane wydarzenie: {{ $event->name }} </h3>
        <h4>data: {{ $event->date }}, wymagana kategoria: {{ $event->requiredCategory->name}}</h4>

        <form action="{{ route('event-user.store') }}" method="POST" class="mt-4">
    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                <h4 class="text-center">Zawodnicy spełniający wymagania kategorii:</h4>
                @if($athletes->isEmpty())
                    <p>Brak zawodników spełniających wymagania kategorii</p>
                @else
                    @foreach($athletes as $athlete)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $athlete->user_id }}" id="athlete_{{ $athlete->user_id }}">
                        <label class="form-check-label" for="athlete_{{ $athlete->user_id }}">
                            {{ $athlete->name }} {{ $athlete->surname }} (Kategoria: {{ $athlete->category->name }})
                        </label>
                    </div>
                    @endforeach
                @endif
                <button type="submit" class="btn btn-primary w-100 mt-3">Zapisz wybranych zawodników</button>
            </div>
        </div>
    </div>
</form>






        <div class="container mt-3">
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Powróć do panelu admina</a>
                </div>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
