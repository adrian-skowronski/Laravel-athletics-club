@include('shared.html')

@include('shared.head', ['pageTitle' => 'Edytuj dane sportu'])

<body>
    @include('shared.navbar')
    
    <div class="container mt-5 mb-5">
    @include('shared.session-error')
    @include('shared.validation-error')
        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj dane sportu</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('sports.update', $sport->sport_id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Nazwa</label>
                        <input id=" name" name="name" type="text" class="form-control @if ($errors->first('name')) is-invalid @endif" value="{{ $sport->name }}" required maxlength="100">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
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
