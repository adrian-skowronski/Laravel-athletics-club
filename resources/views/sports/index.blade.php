@include('shared.html')

@include('shared.head', ['pageTitle' => 'Sporty - lista'])


<body>
    
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-5 mb-3">
            <h1>Lista sportów</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 d-flex justify-content-center">
            <a href="{{ route('sports.create') }}" class="btn btn-primary" style="width: auto; white-space: nowrap;">Dodaj nowy sport</a>
        </div>
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID sportu</th>
                        <th scope="col">Nazwa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sports as $sport)
                        <tr>
                            <td>{{ $sport->sport_id }}</td>
                            <td>{{ $sport->name }}</td>
                            <td>
                                <a href="{{ route('sports.edit', $sport->sport_id) }}" class="btn btn-warning">Edycja</a>
                                <form method="POST" action="{{ route('sports.destroy', $sport->sport_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Brak sportów do wyświetlenia.</td>
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
