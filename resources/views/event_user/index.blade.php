@include('shared.html')

@include('shared.head', ['pageTitle' => 'Uczestnicy wydarzeń - lista'])

<body>
    @include('shared.navbar')

    <div class="container">
        <div class="row mt-3 mb-3">
            <h1>Lista przypisań użytkowników do wydarzeń</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 d-flex justify-content-center">
        <a href="{{ route('event_user.create') }}" class="btn btn-primary" style="width: auto; white-space: nowrap;">Dodaj nowe przypisanie</a>
        </div>
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Wydarzenie</th>
                        <th scope="col">Data</th>
                        <th scope="col">Użytkownik</th>
                        <th scope="col">Punkty</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($eventUsers as $eventUser)
                        <tr>
                            <td>{{ $eventUser->event->name }}</td>
                            <td>{{ $eventUser->event->date }}</td>
                            <td>{{ $eventUser->user->name }} {{ $eventUser->user->surname }}</td>
                            <td>{{ $eventUser->points }}</td>
                            <td>
                                <a href="{{ route('event_user.edit', $eventUser->id) }}" class="btn btn-warning">Edycja</a>
                                <form method="POST" action="{{ route('event_user.destroy', $eventUser->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Brak przypisań do wyświetlenia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                {{ $eventUsers->links('pagination::bootstrap-4') }}
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
