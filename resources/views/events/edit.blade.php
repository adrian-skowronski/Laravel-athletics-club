@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj dane wydarzenia'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        @include('shared.session-error')
        @include('shared.validation-error')

        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj dane wydarzenia</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('events.update', $event->event_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Nazwa</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}" required maxlength="100">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="description" class="form-label">Opis</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" maxlength="500">{{ $event->description }}</textarea>
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="required_category_id" class="form-label">Minimalna kategoria</label>
                        <select id="required_category_id" name="required_category_id" class="form-select @error('required_category_id') is-invalid @enderror" required>
                            <option value="">Wybierz kategorię</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('required_category_id', $event->required_category_id) == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowa kategoria!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_from" class="form-label">Wiek od</label>
                        <input id="age_from" name="age_from" type="number" class="form-control @error('age_from') is-invalid @enderror" value="{{ $event->age_from }}" required min="0">
                        <div class="invalid-feedback">Nieprawidłowy wiek od!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_to" class="form-label">Wiek do</label>
                        <input id="age_to" name="age_to" type="number" class="form-control @error('age_to') is-invalid @enderror" value="{{ $event->age_to }}" required min="{{ $event->age_from }}">
                        <div class="invalid-feedback">Nieprawidłowy wiek do!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="date" class="form-label">Dzień</label>
                        <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $event->date }}" required min="2024-01-01">
                        <div class="invalid-feedback">Nieprawidłowa data! Data musi być późniejsza niż 01-01-2024.</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="start_hour" class="form-label">Godzina</label>
                        <input id="start_hour" name="start_hour" type="time" class="form-control @error('start_hour') is-invalid @enderror" value="{{ $event->start_hour }}" required>
                        <div class="invalid-feedback">Nieprawidłowa godzina rozpoczęcia!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="max_participants" class="form-label">Maks. liczba uczest.</label>
                        <input id="max_participants" name="max_participants" type="number" class="form-control @error('max_participants') is-invalid @enderror" value="{{ $event->max_participants }}" required min="3" max="299">
                        <div class="invalid-feedback">Nieprawidłowa liczba uczestników! Minimalna liczba to 3, maksymalna to 299.</div>
                    </div>

                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Zapisz zmiany">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
