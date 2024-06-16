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
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $event->name }}">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="description" class="form-label">Opis</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ $event->description }}</textarea>
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="category" class="form-label">Kategoria</label>
                        <input id="category" name="category" type="text" class="form-control @error('category') is-invalid @enderror" value="{{ $event->category }}">
                        <div class="invalid-feedback">Nieprawidłowa kategoria!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_from" class="form-label">Wiek od</label>
                        <input id="age_from" name="age_from" type="range" min="0" max="100" class="form-control @error('age_from') is-invalid @enderror" value="{{ $event->age_from }}"
                        oninput="ageFrom.innerText = this.value">
                        <p id="ageFrom">{{$event->age_from}}</p>
                        <div class="invalid-feedback">Nieprawidłowy wiek od!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="age_to" class="form-label">Wiek do</label>
                        <input id="age_to" name="age_to" type="range" min="0" max="100" class="form-control @error('age_to') is-invalid @enderror" value="{{ $event->age_to }}"
                        oninput="ageTo.innerText = this.value">
                        <p id="ageTo">{{$event->age_to}}</p>
                        <div class="invalid-feedback">Nieprawidłowy wiek do!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="date" class="form-label">Dzień</label>
                        <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $event->date }}">
                        <div class="invalid-feedback">Nieprawidłowa data!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="start_hour" class="form-label">Godzina</label>
                        <input id="start_hour" name="start_hour" type="time" class="form-control input-md @error('start_hour') is-invalid @enderror" value="{{ $event->start_hour }}">
                        <div class="invalid-feedback">Nieprawidłowa godzina rozpoczęcia!</div>
                    </div>

                    
                    <div class="form-group mb-2">
                        <label for="max_participants" class="form-label">Maks. liczba uczest.</label>
                        <input id="max_participants" name="max_participants" type="number" class="form-control @error('max_participants') is-invalid @enderror" value="{{ $event->max_participants }}">
                        <div class="invalid-feedback">Nieprawidłowa liczba!</div>
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
