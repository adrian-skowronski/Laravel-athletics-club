@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj Profil'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <h2>Edytuj Profil</h2>
        <form action="{{ route('athlete.update', $user->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Imię</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="surname">Nazwisko</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{{ $user->surname }}" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Data Urodzenia</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ $user->birthdate }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Zdjęcie (do 5MB)</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg" class="form-control-file" >
            </div>
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        </form>
    </div>
    @include('shared.footer')
</body>
