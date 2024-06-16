@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edycja Statusu Treningu'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Edycja Statusu Treningu</h1>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Trening: {{ $training->date }}</h5>
                        <h5 class="card-title">Uczestnik: {{ $user->name }} {{ $user->surname }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('trainer.updateStatus', ['training_id' => $training->training_id, 'user_id' => $user->user_id]) }}" method="POST" class="p-3 border rounded">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="obecność" {{ $user->status == 'obecność' ? 'selected' : '' }}>Obecność</option>
                            <option value="nieobecność" {{ $user->status == 'nieobecność' ? 'selected' : '' }}>Nieobecność</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="points" class="form-label">Punkty</label>
                        <input type="number" id="points" name="points" class="form-control" value="{{ $user->points }}" required max="{{ $training->max_points }}" pattern="\d*">
                        <div class="invalid-feedback">Punkty muszą być liczbą całkowitą z zakresu do {{ $training->max_points }}.</div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
