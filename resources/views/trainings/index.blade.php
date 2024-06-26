@include('shared.html')

@include('shared.head', ['pageTitle' => 'Treningi - lista'])


<body>
    
    @include('shared.navbar')

    <div class="container mt-3 mb-5">
        <div class="row mt-3 mb-3">
            <h1>Lista treningów</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 d-flex justify-content-center">
            <a href="{{ route('trainings.create') }}" class="btn btn-primary" style="width: auto; white-space: nowrap;">Dodaj nowy trening</a>
        </div>
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Opis</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Od</th>
                        <th scope="col">Do</th>
                        <th scope="col">Sport</th>
                        <th scope="col">Trener</th>
                        <th scope="col">Max. pkt</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trainings as $training)
                        <tr>
                            <td>{{ $training->description }}</td>
                            <td>{{ $training->date }}</td>
                            <td>{{ $training->start_time }}</td>
                            <td>{{ $training->end_time }}</td>
                            <td>{{ $training->trainer->sport->name }}</td>
                            <td>{{ $training->trainer->name }} {{ $training->trainer->surname }}</a></td>                           
                            <td>{{ $training->max_points }}</td>
                            <td>
                                <a href="{{ route('trainings.edit', $training->training_id) }}" class="btn btn-warning">Edycja</a>
                                <form method="POST" action="{{ route('trainings.destroy', $training->training_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Brak treningów do wyświetlenia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">
            {{ $trainings->links('pagination::bootstrap-4') }}
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
