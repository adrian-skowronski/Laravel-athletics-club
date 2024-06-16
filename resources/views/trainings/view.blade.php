@include('shared.html')
@include('shared.head', ['pageTitle' => 'Treningi - lista'])

<body>
    @include('shared.navbar')

    <div class="container mt-3">
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

    <div class="container mt-3 mb-5">
    
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
                        <th scope="col">Sport</th>
                        <th scope="col">Trener</th>
                        <th scope="col">Zapisz się</th>
                    </tr>
                </thead>
                <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    @forelse ($trainings as $training)
                        <tr>
                            <td>{{$training->description}}</td>
                            <td>{{$training->date}}</td>
                            <td>{{$training->start_time}}</td>
                            <td>{{$training->end_time}}</td>
                            <td>{{ $training->trainer->sport->name }}</td>
                            <td><a href="{{ route('trainer.details', $training->trainer->user_id) }}">{{ $training->trainer->name }} {{ $training->trainer->surname }}</a></td>
                                <td>            
                                @auth
                                    @if($training->userCanSignUp(auth()->user()))
                                        <form action="{{ route('training.signUp', $training->training_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Zapisz się</button>
                                        </form>
                                        @else
                                        <em>Opcja niedostępna</em>
                                        @endif
                                        @else
                                        <em>Opcja niedostępna</em>
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
            
            <div class="mt-2">
            {{ $trainings->links('pagination::bootstrap-4') }}
            </div>  
        </div>
    </div>
    @include('shared.footer')
</body>
