@include('shared.html')
@include('shared.head', ['pageTitle' => 'Wydarzenia - lista'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
    @include('shared.session-error')
    @include('shared.validation-error')
        <div class="row mb-1">
            <h1>Lista wydarzeń</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 ">
            <div class="col d-flex justify-content-center">
            <a href="{{ route('events.create') }}" class="btn btn-primary">Dodaj nowe wydarzenie</a>
</div>
        </div>
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Wymagana kategoria</th>
                        <th scope="col">Wiek od</th>
                        <th scope="col">Wiek do</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Godzina</th>
                        <th scope="col">Maks. liczba uczest.</th>
                        <th scope="col">Aktualnie uczest.</th>
                        <th scope="col">Zapisz sportowca</th>
                        <th scope="col">Edytuj</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->requiredCategory->name }}</td>
                            <td>{{ $event->age_from }}</td>
                            <td>{{ $event->age_to }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->start_hour }}</td>
                            <td>{{ $event->max_participants }}</td>
                            <td>{{ $event->users_count }}</td> 
                            <td>
                            <a href="{{ route('event-user.select_athletes', ['event_id' => $event->event_id]) }}" class="btn btn-primary">Zapisz</a>
</td>
<td>
                                <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning">Edytuj</a>
</td>
<td>    
                                <form method="POST" action="{{ route('events.destroy', $event->event_id) }}" onsubmit="return confirm('Czy na pewno chcesz usunąć?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Brak wydarzeń do wyświetlenia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="row">
    <div class="d-flex justify-content-center mt-2">
        {{ $events->links('pagination::bootstrap-4') }}
    </div>
</div>

            <div class="container mt-3">
                <div class="row">
                    <div class="col text-center">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Powróć do panelu admina</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
