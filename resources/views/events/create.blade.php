@include('shared.html')

@include('shared.head', ['pageTitle' => 'Dodaj nowe wydarzenie'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe wydarzenie</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Nazwa</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="description" class="form-label">Opis</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="category" class="form-label">Kategoria</label>
                        <input id="category" name="category" type="text" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                        <div class="invalid-feedback">Nieprawidłowa kategoria!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_from" class="form-label">Wiek od</label>
                        <input id="age_from" name="age_from" type="number" class="form-control @error('age_from') is-invalid @enderror" value="{{ old('age_from') }}">
                        <div class="invalid-feedback">Nieprawidłowy wiek od!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_to" class="form-label">Wiek do</label>
                        <input id="age_to" name="age_to" type="number" class="form-control @error('age_to') is-invalid @enderror" value="{{ old('age_to') }}">
                        <div class="invalid-feedback">Nieprawidłowy wiek do!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="date" class="form-label">Dzień</label>
                        <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        <div class="invalid-feedback">Nieprawidłowa data!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="start_hour" class="form-label">Godzina</label>
                        <input id="start_hour" name="start_hour" type="time" class="form-control @error('start_hour') is-invalid @enderror" value="{{ old('start_hour') }}">
                        <div class="invalid-feedback">Nieprawidłowa godzina rozpoczęcia!</div>
                    </div>
                    
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Dodaj">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
