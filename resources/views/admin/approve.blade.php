@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zatwierdzanie użytkownika'])
@include('shared.navbar')
<div class="container">
    <h1>Zatwierdzanie użytkownika</h1>

    <form method="POST" action="{{ route('admin.storeApproval', $user->user_id) }}">
        @csrf
        @method('POST')
        
        <div class="form-group">
            <label for="points">Punkty</label>
            <input type="number" id="points" name="points" class="form-control" value="{{ old('points') }}" required>
        </div>

        <div class="form-group">
            <label for="sport_id">Sport</label>
            <select id="sport_id" name="sport_id" class="form-select" required>
                @foreach($sports as $sport)
                    <option value="{{ $sport->sport_id }}">{{ $sport->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="role_id">Rola</label>
            <select id="role_id" name="role_id" class="form-select" required>
                @foreach($roles as $role)
                    <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Kategoria</label>
            <select id="category_id" name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Zatwierdź</button>
    </form>
</div>
@include('shared.footer')
