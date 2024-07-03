@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj przypisanie użytkownika do wydarzenia'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                @include('shared.session-error')
                @include('shared.validation-error')

                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="text-center mb-4">
                            <h1>Edytuj przypisanie użytkownika do wydarzenia</h1>
                        </div>

                        <h3 class="card-title">Wydarzenie: {{$eventUser->event->name}}</h3>
                        <h3 class="card-title">Data: {{$eventUser->event->date}}</h3>
                        <h3 class="card-title">Sportowiec: {{$eventUser->user->name}} {{$eventUser->user->surname}}</h3>
                        
                        <form method="POST" action="{{ route('event-user.update', $eventUser->event_user_id) }}">
                            @csrf
                            @method('PUT')
                            
                            <input type="hidden" name="event_id" value="{{ $eventUser->event_id }}">
                            <input type="hidden" name="user_id" value="{{ $eventUser->user_id }}">
                            
                            <div class="form-group">
                                <label for="points">Punkty</label>
                                <select class="form-select" id="points" name="points">
                                    <option value="40" {{ $eventUser->points == 40 ? 'selected' : '' }}>1 miejsce: 40 pkt</option>
                                    <option value="30" {{ $eventUser->points == 30 ? 'selected' : '' }}>2 miejsce: 30 pkt</option>
                                    <option value="20" {{ $eventUser->points == 20 ? 'selected' : '' }}>3 miejsce: 20 pkt</option>
                                    <option value="10" {{ $eventUser->points == 10 ? 'selected' : '' }}>4-10 miejsce: 10 pkt</option>
                                    <option value="5" {{ $eventUser->points == 5 ? 'selected' : '' }}>Pozostałe miejsca: 5 pkt</option>
                                    <option value="0" {{ $eventUser->points == 0 ? 'selected' : '' }}>Brak udziału: 0 pkt</option>
                                </select>
                            </div>

                            <button type="submit" class="mt-3 btn btn-primary btn-block">Zapisz zmiany</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
