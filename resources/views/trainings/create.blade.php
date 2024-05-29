@include('shared.html')
@include('shared.head', ['pageTitle' => 'Dodaj nowy trening'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowy trening</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('trainings.store') }}">
                    @csrf

                    <div class="form-group mb-2">
                        <label for="description" class="form-label">Opis</label>
                        <input id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>

                    </div>

                    <div class="form-group mb-2">
                        <label for="date" class="form-label">Dzień</label>
                        <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                        <div class="invalid-feedback">Nieprawidłowa dzień!</div>

                    </div>

                    <div class="form-group mb-2">
                        <label for="start_time" class="form-label">Godzina rozpoczęcia</label>
                        <input id="start_time" name="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}">
                        <div class="invalid-feedback">Nieprawidłowa godzina rozpoczęcia!</div>

                    </div>

                    <div class="form-group mb-2">
                        <label for="end_time" class="form-label">Godzina zakończenia</label>
                        <input id="end_time" name="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}">
                        <div class="invalid-feedback">Nieprawidłowa godzina zakończenia!</div>

                    </div>

                    <div class="form-group mb-2">
                        <label for="trainer_id" class="form-label">Trener</label>
                        <select id="trainer_id" name="trainer_id" class="form-control @error('trainer_id') is-invalid @enderror">
                            <option value="">Wybierz trenera</option>
                            @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->user_id }}" @if (old('trainer_id') == $trainer->user_id) selected @endif>{{ $trainer->name }} {{ $trainer->surname }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowy trener!</div>

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
