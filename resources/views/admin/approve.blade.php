@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zatwierdzanie użytkownika'])
@include('shared.navbar')
<div class="d-flex justify-content-center align-items-center">
    <div class="container">
        @include('shared.session-error')
        @include('shared.validation-error')
        <h1 class="mt-5">Zatwierdzanie użytkownika</h1>
        <h2>Wypełnij dane dla: {{$user->name}} {{$user->surname}}</h2>

        <form method="POST" action="{{ route('admin.storeApproval', $user->user_id) }}">
            @csrf
            @method('POST')
            
            <div class="form-group mt-3">
                    <label for="points"><b>Punkty</b></label>
                    <input type="number" id="points" name="points" class="form-control w-auto" value="{{ old('points') }}" required>
                </div>

            <div class="form-group mt-3">
                <label><b>Sport</b></label><br>
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

            <div class="form-group mt-3">
                <label><b>Rola</b></label><br>
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

            <div class="form-group mt-3">
                <label><b>Kategoria</b></label><br>
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

            <button type="submit" class="btn btn-success mt-3 mb-3">Zatwierdź</button>
        </form>
    </div>
</div>
@include('shared.footer')
