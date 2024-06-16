@include('shared.html')

@include('shared.head', ['pageTitle' => 'Dodaj nowe wydarzenie'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
    @include('shared.session-error')
    @include('shared.validation-error')
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
                        <input id="age_from" name="age_from" type="range" min="0" max="100" class="form-control @error('age_from') is-invalid @enderror" value="0"
                        oninput="ageFrom.innerText = this.value">
                        <p id="ageFrom">0</p>
                        <div class="invalid-feedback">Nieprawidłowy wiek od!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_to" class="form-label">Wiek do</label>
                        <input id="age_to" name="age_to" type="range" min="0" max="100" class="form-control @error('age_to') is-invalid @enderror" value="0"
                        oninput="ageTo.innerText = this.value">
                        <p id="ageTo">0</p>
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
                    
                    <div class="form-group mb-2">
                        <label for="max_participants" class="form-label">Maksymalna liczba uczestników</label>
                        <input id="max_participants" name="max_participants" type="number" class="form-control @error('max_participants') is-invalid @enderror" value="{{ old('max_participants') }}">
                        <div class="invalid-feedback">Nieprawidłowa liczba!</div>
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
<script>
    function updateAgeRange() {
        var ageFrom = document.getElementById('age_from').value;
        var ageTo = document.getElementById('age_to').value;
        if (parseInt(ageFrom) > parseInt(ageTo)) {
            var temp = ageFrom;
            ageFrom = ageTo;
            ageTo = temp;
        }
        document.getElementById('age_range').innerText = ageFrom + ' - ' + ageTo;
    }

    // Inicjalizacja wartości na początku
    document.addEventListener('DOMContentLoaded', function() {
        updateAgeRange();
    });
</script>
</html>
