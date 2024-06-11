@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edycja Statusu Uczestnika'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <h1>Edycja Statusu Uczestnika</h1>
        <form action="{{ route('trainer.updateStatus', ['training_id' => $training->training_id, 'user_id' => $user->user_id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="obecność" {{ $user->status == 'obecność' ? 'selected' : '' }}>Obecność</option>
                    <option value="nieobecność" {{ $user->status == 'nieobecność' ? 'selected' : '' }}>Nieobecność</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="points" class="form-label">Punkty</label>
                <input type="number" id="points" name="points" class="form-control" value="{{ $user->points }}" required  max="{{ $training->max_points }}" pattern="\d*">
                <div class="invalid-feedback">Punkty muszą być liczbą całkowitą z zakresu do {{ $training->max_points }}.</div>
            </div>
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </form>
    </div>
    @include('shared.footer')
</body>
</html>
