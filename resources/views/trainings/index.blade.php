@include('shared.html')

@include('shared.head', ['pageTitle' => 'Treningi - lista'])

<body>
    @include('shared.navbar')

    <div class="container mt-5 mb-5">
        <div class="row mb-1">
            <h1>Lista treningów</h1>
        </div>
        <div class="row mb-2">
            <a href="{{ route('trainings.create') }}">Dodaj nową wycieczkę</a>
        </div>
        <div class="row">
            <table class="table table-hover table-straininged">
                <thead>
                    <tr>
                        <th scope="col">Sport</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Od</th>
                        <th scope="col">Do</th>
                        <th scope="col">Trener</th>
                    </tr>
                </thead>
                <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                         bbbbbbbb
                    @forelse ($trainings as $training)
                        <tr>
                            <td>{{$training->sport}}</td>
                            <td>{{$training->description}}</td>
                            <td>{{$training->day}}</td>
                            <td>{{$training->start_time}}</td>
                            <td>{{$training->end_time}}</td>
                            <td>{{$training->user_idwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww}}</td>

                            <td><a href="{{route('trainings.edit', $training->training_id)}}">Edycja</a></td> 
                            <td> 
 <form method="POST" action="{{ route('trainings.destroy', $training->training_id) }}"> 
 @csrf 
 @method('DELETE') 
 <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>

 </form> 
</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak wycieczek.</th>
                        </tr>
                    @endforelse
                </tbody>
                
                
            </table>

            <div class="container mt-3">
    <div class="row">
        <div class="col text-center">
            <a href="{{ route('admin') }}" class="btn btn-secondary">Powróć do panelu admina</a>
        </div>
    </div>
</div>
        </div>
    </div>

    @include('shared.footer')
</body>

</html>
