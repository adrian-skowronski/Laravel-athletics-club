@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj przypisanie użytkownika do wydarzenia'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        @include('shared.session-error')
        @include('shared.validation-error')

        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj przypisanie użytkownika do wydarzenia</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('event_user.update', $eventUser->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-2">
                        <label for="event_id" class="form-label">Wydarzenie</label>
                        <select id="event_id" name="event_id" class="form-select @error('event_id') is-invalid @enderror">
                            <option value="">Wybierz wydarzenie</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" @if ($event->id == $eventUser->event_id) selected @endif>{{ $event->name }} ({{ $event->date }})</option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="user_id" class="form-label">Użytkownik</label>
                        <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">Wybierz użytkownika</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($user->id == $eventUser->user_id) selected @endif>{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="points" class="form-label">Punkty</label>
                        <select id="points" name="points" class="form-select @error('points') is-invalid @enderror">
                            <option value="50" @if ($eventUser->points == 50) selected @endif>1 miejsce -> 50 pkt</option>
                            <option value="40" @if ($eventUser->points == 40) selected @endif>2 miejsce -> 40 pkt</option>
                            <option value="30" @if ($eventUser->points == 30) selected @endif>3 miejsce -> 30 pkt</option>
                            <option value="20" @if ($eventUser->points == 20) selected @endif>miejsca 4-10 -> 20 pkt</option>
                            <option value="10" @if ($eventUser->points == 10) selected @endif>miejsca 11-20 -> 10 pkt</option>
                            <option value="5" @if ($eventUser->points == 5) selected @endif>pozostałe miejsca -> 5 pkt</option>
                        </select>
                        @error('points')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div
