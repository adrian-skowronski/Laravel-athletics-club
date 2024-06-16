@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zapisy na wydarzenia'])

<body>
@include('shared.navbar')
<div class="container mt-5">
    <h1 class="mb-3">Rejestracja na wydarzenia</h1>

    <form action="{{ route('admin.fetch_athletes') }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Pokaż sportowców</button>
    </form>

    @isset($athletes)
    <form action="{{ route('admin.register_athletes') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
        <div class="mt-5">
            <h3>Zawodnicy spełniający wymagania</h3>
            @foreach($athletes as $athlete)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="athletes[]" value="{{ $athlete->user_id }}" id="athlete_{{ $athlete->user_id }}">
                <label class="form-check-label" for="athlete_{{ $athlete->user_id }}">
                    {{ $athlete->name }} {{ $athlete->surname }} (Kategoria: {{ $athlete->category->name }})
                </label>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-3">Zapisz wybranych zawodników</button>
    </form>
    @endisset
</div>
@include('shared.footer')
