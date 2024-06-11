@include('shared.html')
@include('shared.head', ['pageTitle' => 'Treningi - lista'])

<body>
    @include('shared.navbar')

    <div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

    <div class="container mt-5 mb-5">
    
        <div class="row mb-1">
            <h1>Lista treningów</h1>
        </div>
        <div class="row">
            <table class="table table-hover table-straininged">
                <thead>
                    <tr>
                        <th scope="col">Opis</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Od</th>
                        <th scope="col">Do</th>
                        <th scope="col">Sport [Trener]</th>
                        <th scope="col">Akcja</th>
                    </tr>
                </thead>
                <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    @forelse ($trainings as $training)
                        <tr>
                            <td>{{$training->description}}</td>
                            <td>{{$training->date}}</td>
                            <td>{{$training->start_time}}</td>
                            <td>{{$training->end_time}}</td>
                            <td>{{ $training->trainer->sport->name }} [{{ $training->trainer->name }} {{ $training->trainer->surname }}]</td>
                            <td>
                                @auth
                                    @if(auth()->user()->role_id == 3 && auth()->user()->sport_id == $training->trainer->sport->sport_id)
                                        <form action="{{ route('training.signUp', $training->training_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Zapisz się</button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak treningów do wyświetlenia.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('shared.footer')
</body>
