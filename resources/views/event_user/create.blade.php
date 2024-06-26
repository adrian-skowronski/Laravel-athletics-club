@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zapisy na wydarzenia'])

<body>
@include('shared.navbar')
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
    <h1 class="mb-3">Rejestracja na wydarzenia</h1>

    @if(session('success'))
        <div class="alert alert-success w-100" style="max-width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger w-100" style="max-width: 500px;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('event_user.athletes',1) }}" method="POST" class="w-100" style="max-width: 500px;">
        @csrf
        <div class="mb-3">
            <label for="event_id" class="form-label">Wybierz wydarzenie</label>
            <select class="form-select" id="event_id" name="event_id" required>
                <option value="">-- Wybierz wydarzenie --</option>
                @foreach($events as $event)
                <option value="{{ $event->event_id }}" {{ isset($selected_event) && $selected_event->event_id == $event->event_id ? 'selected' : '' }}>
                    {{ $event->name }} ({{ $event->date }})
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Pokaż sportowców</button>
    </form>

    @isset($athletes)
    <form action="{{ route('event_user.store') }}" method="POST" class="w-100 mt-5" style="max-width: 500px;">
        @csrf
        <input type="hidden" name="event_id" value="{{ $selected_event->event_id }}">
        <div>
            <h3>Wybrane wydarzenie: {{ $selected_event->name }}, data: {{ $selected_event->date }}</h3>
            <h4>Zawodnicy spełniający wymagania:</h4>
            @if($athletes->isEmpty())
                <p>Brak zawodników spełniających wymagania</p>
            @else
                @foreach($athletes as $athlete)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="athletes[]" value="{{ $athlete->user_id }}" id="athlete_{{ $athlete->user_id }}">
                    <label class="form-check-label" for="athlete_{{ $athlete->user_id }}">
                        {{ $athlete->name }} {{ $athlete->surname }} (Kategoria: {{ $athlete->category->name }})
                    </label>
                </div>
                @endforeach
            @endif
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">Zapisz wybranych zawodników</button>
    </form>
    @endisset

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
