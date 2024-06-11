@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj Profil'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
    @include('shared.session-error')
    @include('shared.validation-error')

        <h2>Edytuj Profil</h2>
        <form action="{{ route('athlete.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3 col-md-6 col-lg-4">
                <label for="name" class="form-label">Imię</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" >
            </div>
            <div class="mb-3 col-md-6 col-lg-4">
                <label for="surname" class="form-label">Nazwisko</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{{ $user->surname }}" >
            </div>
            <div class="mb-3 col-md-6 col-lg-4">
                <label for="birthdate" class="form-label">Data Urodzenia</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ $user->birthdate }}" >
            </div>
            <div class="mb-3 col-md-6 col-lg-4">
                <label for="phone" class="form-label">Telefon</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" >
            </div>
            <div class="mb-3 col-md-6 col-lg-4">
                <label for="photo" class="form-label">Zdjęcie (do 5MB)</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
        </form>
    </div>
    @include('shared.footer')
</body>
