@include('shared.html')

@include('shared.head', ['pageTitle' => 'Sporty - lista'])


<body>
    
    @include('shared.navbar')


    <div class="container mt-5 mb-5">
    @include('shared.session-error')
    @include('shared.validation-error')
        <div class="row mt-5 mb-3">
            <h1>Lista sportów</h1>
        </div>
        <div class="row mb-3 mt-3">
    <div class="col d-flex justify-content-center">
        <a href="{{ route('sports.create') }}" class="btn btn-primary">Dodaj nowy sport</a>
    </div>
</div>

        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID sportu</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Edytuj</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sports as $sport)
                        <tr>
                            <td>{{ $sport->sport_id }}</td>
                            <td>{{ $sport->name }}</td>
                            <td>
                                <a href="{{ route('sports.edit', $sport->sport_id) }}" class="btn btn-warning">Edytuj</a>
</td>
<td>
                                <form method="POST" action="{{ route('sports.destroy', $sport->sport_id) }}">
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
