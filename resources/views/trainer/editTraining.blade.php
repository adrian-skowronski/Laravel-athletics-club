@include('shared.html')

@include('shared.head', ['pageTitle' => 'Edytuj dane treningu'])

<body>
    @include('shared.navbar')
    
    <div class="container mt-5 mb-5">
    @include('shared.session-error')
    @include('shared.validation-error')
        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj dane treningu</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('trainer.updateTraining', $training->training_id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Opis</label>
                        <input id="description" name="description" type="text" class="form-control @if ($errors->first('description')) is-invalid @endif" value="{{ $training->description }}">
                        <div class="invalid-feedback">Nieprawidłowy opis!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Dzień</label>
                        <input id="date" name="date" type="date" class="form-control @if ($errors->first('date')) is-invalid @endif" value="{{ $training->date }}">
                        <div class="invalid-feedback">Nieprawidłowa data!</div>
                    </div>

                    <div class="form-group mb-2">
        <label for="start_time" class="form-label">Godzina rozpoczęcia</label>
        <input id="start_time" name="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $training->start_time) }}">
        @error('start_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="end_time" class="form-label">Godzina zakończenia</label>
        <input id="end_time" name="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $training->end_time) }}">
        @error('end_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group mb-2">
                        <label for="max_points" class="form-label">Maksymalna liczba punktów</label>
                        <input id="max_points" name="max_points" type="text" class="form-control @if ($errors->first('max_points')) is-invalid @endif" value="{{ $training->max_points }}">
                        <div class="invalid-feedback">Nieprawidłowa liczba!</div>
                    </div>
                    
                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Wyślij">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared.footer')
</body>

</html>
