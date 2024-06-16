@include('shared.html')

@include('shared.head', ['pageTitle' => 'Wydarzenia - lista'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            <h1>Lista wydarzeń</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 d-flex justify-content-center">
            <a href="{{ route('events.create') }}" class="btn btn-primary" style="width: auto; white-space: nowrap;">Dodaj nowe wydarzenie</a>
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
                        <th scope="col">Akcje</th>
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
                            <td>
                                <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning">Edycja</a>
                                <form method="POST" action="{{ route('events.destroy', $event->event_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Brak wydarzeń do wyświetlenia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

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
