@include('shared.html')

@include('shared.head', ['pageTitle' => 'Treningi - lista'])

<body>
    @include('shared.navbar')
    <br><br>
    <div class="container mt-5 mb-5">
        <div class="row mb-1">
        
            <h1>Lista treningów</h1>
            <br><br>
        </div>
        <div class="row">
            <table class="table table-hover table-straininged">
                <thead>
                    <tr>
                        <th scope="col">Opis</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Od</th>
                        <th scope="col">Do</th>
                        <th scope="col">Trener</th>
                    </tr>
                </thead>
                <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    @forelse ($trainings as $training)
                        <tr>
                            <td>{{$training->description}}</td>
                            <td>{{$training->date}}</td>
                            <td>{{$training->start_time}}</td>
                            <td>{{$training->end_time}}</td>
                            <td>{{ $training->trainer->name }} {{ $training->trainer->surname }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak treningów do wyświetlenia.</th>
                        </tr>
                    @endforelse
                </tbody>
                
                
            </table>

            <div class="container mt-3">
    
</div>
        </div>
    </div>

    @include('shared.footer')
</body>


