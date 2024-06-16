@include('shared.html')
@include('shared.head', ['pageTitle' => 'Lista użytkowników - panel admina'])

<style>
    .pagination {
        display: flex;
        justify-content: center;
    }
    .pagination .page-item {
        margin: 0 5px;
    }
    .pagination .page-link {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
    
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-5 mb-3">
            <h1>Lista użytkowników</h1>
        </div>
        <div class="row mb-3 mt-3 p-3 d-flex justify-content-center">
            <a href="{{ route('users.create') }}" class="btn btn-primary" style="width: auto; white-space: nowrap;">Dodaj nowego użytkownika</a>
        </div>
        
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Data urodzenia</th>
                        <th scope="col">Punkty</th>
                        <th scope="col">Telefon</th>
                        <th scope="col">Rola</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Sport</th>
                        <th scope="col">Zatwierdzony</th>
                        <th scope="col">Zdjęcie</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthdate }}</td>
                            <td>{{ $user->points }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role ? $user->role->name : 'Brak kategorii' }}</td>                            
                            <td>{{ $user->category ? $user->category->name : 'Brak kategorii' }}</td>
                            <td>{{ $user->sport ? $user->sport->name : 'Brak sportu' }}</td>
                            <td>{{ $user->approved ? 'Tak' : 'Nie' }}</td>
                            <td><img src="{{ asset($user->photo) }}" alt="Zdjęcie użytkownika" style="max-width: 100px; max-height: 100px;"></td>
                            <td>
                                <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-primary">Edytuj</a>
                                <form method="POST" action="{{ route('users.destroy', $user->user_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Brak użytkowników do wyświetlenia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="row">
        <div class="mt-2">
            {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col text-center">
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Powróć do panelu admina</a>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
