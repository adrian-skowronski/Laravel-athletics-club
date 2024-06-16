@include('shared.html')
@include('shared.head', ['pageTitle' => 'Edytuj użytkownika'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        @include('shared.session-error')
        @include('shared.validation-error')

        <div class="row mt-4 mb-4 text-center">
            <h1>Edytuj użytkownika - {{ $user->name }} {{ $user->surname }}</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <form method="POST" action="{{ route('users.update', $user->user_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Imię</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                        <div class="invalid-feedback">Nieprawidłowe imię!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="surname" class="form-label">Nazwisko</label>
                        <input id="surname" name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname', $user->surname) }}">
                        <div class="invalid-feedback">Nieprawidłowe nazwisko!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                        <div class="invalid-feedback">Nieprawidłowy adres e-mail!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="birthdate" class="form-label">Data urodzenia</label>
                        <input id="birthdate" name="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', $user->birthdate) }}">
                        <div class="invalid-feedback">Nieprawidłowa data urodzenia!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="points" class="form-label">Punkty</label>
                        <input id="points" name="points" type="number" class="form-control @error('points') is-invalid @enderror" value="{{ old('points', $user->points) }}">
                        <div class="invalid-feedback">Nieprawidłowe punkty!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="phone" class="form-label">Telefon</label>
                        <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                        <div class="invalid-feedback">Nieprawidłowy numer telefonu!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="role_id" class="form-label">Rola</label>
                        <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                            <option value="">Wybierz rolę</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}" @if (old('role_id', $user->role_id) == $role->role_id) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowa rola!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="category_id" class="form-label">Kategoria</label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Wybierz kategorię</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" @if (old('category_id', $user->category_id) == $category->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowa kategoria!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="sport_id" class="form-label">Sport</label>
                        <select id="sport_id" name="sport_id" class="form-select @error('sport_id') is-invalid @enderror">
                            <option value="">Wybierz sport</option>
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->sport_id }}" @if (old('sport_id', $user->sport_id) == $sport->sport_id) selected @endif>{{ $sport->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Nieprawidłowy sport!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="approved" class="form-label">Zatwierdzony</label>
                        <select id="approved" name="approved" class="form-select @error('approved') is-invalid @enderror">
                            <option value="0" @if (old('approved', $user->approved) == '0') selected @endif>Nie</option>
                            <option value="1" @if (old('approved', $user->approved) == '1') selected @endif>Tak</option>
                        </select>
                        <div class="invalid-feedback">Nieprawidłowy status zatwierdzenia!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="photo" class="form-label">Zdjęcie</label>
                        <input id="photo" name="photo" type="file" class="form-control @error('photo') is-invalid @enderror">
                        <div class="invalid-feedback">Nieprawidłowe zdjęcie!</div>
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
