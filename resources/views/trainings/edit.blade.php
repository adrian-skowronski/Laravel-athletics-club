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
                <form method="POST" action="{{ route('trainings.update', $training->training_id) }}">
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
                        <input id="start_time" name="start_time" type="time" class="form-control @if ($errors->first('start_time')) is-invalid @endif" value="{{ old('start_time', $training->start_time) }}">
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="end_time" class="form-label">Godzina zakończenia</label>
                        <input id="end_time" name="end_time" type="time" class="form-control @if ($errors->first('end_time')) is-invalid @endif" value="{{ old('end_time', $training->end_time) }}">
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group mb-2">
                        <label for="trainer_id" class="form-label">Trener</label>
                        <select id="trainer_id" name="trainer_id" class="form-select @if ($errors->first('trainer_id')) is-invalid @endif">
                            <option value="">Wybierz trenera</option>
                            @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->user_id }}" @if ($trainer->user_id == $training->trainer_id) selected @endif>{{ $trainer->name }} {{ $trainer->surname }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowe ID trenera!</div>
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
