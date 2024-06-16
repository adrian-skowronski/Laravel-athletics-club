@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zatwierdzanie użytkownika'])
@include('shared.navbar')
<div class="container">
@include('shared.session-error')
@include('shared.validation-error')
    <h1 class="mt-5">Zatwierdzanie użytkownika</h1>

    <form method="POST" action="{{ route('admin.storeApproval', $user->user_id) }}">
        @csrf
        @method('POST')
        
        <div class="form-group">
            <label for="points">Punkty</label>
            <input type="number" id="points" name="points" class="form-control" value="{{ old('points') }}" required>
        </div>

        <div class="form-group">
    <label>Sport</label><br>
    @foreach($sports as $sport)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sport_id" id="sport_{{ $sport->sport_id }}" value="{{ $sport->sport_id }}" {{ old('sport_id') == $sport->sport_id ? 'checked' : '' }}>
            <label class="form-check-label" for="sport_{{ $sport->sport_id }}">
                {{ $sport->name }}
            </label>
        </div>
    @endforeach
    @error('sport_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


        <div class="form-group">
    <label>Rola</label><br>
    @foreach($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role_id" id="role_{{ $role->role_id }}" value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'checked' : '' }}>
            <label class="form-check-label" for="role_{{ $role->role_id }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
    @error('role_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


        <div class="form-group">
            <label>Kategoria</label><br>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category_id" id="category_{{ $category->category_id }}" value="{{ $category->category_id }}">
                    <label class="form-check-label" for="category_{{ $category->category_id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
            @error('category_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Zatwierdź</button>
    </form>
</div>
@include('shared.footer')
