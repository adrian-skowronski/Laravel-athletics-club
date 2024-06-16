@include('shared.html')

@include('shared.head', ['pageTitle' => 'Zawody - lista'])

<body>
    @include('shared.navbar')
    <div class="container mt-5 mb-5">
        <div class="row mb-1">
        
            <h1>Lista zawodów</h1>
        </div>
        <div class="row">
            <table class="table table-hover table-straininged">
                <thead>
                    <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Wiek od</th>
                        <th scope="col">Wiek do</th>
                        <th scope="col">Dzień</th>
                        <th scope="col">Godzina</th>
                        <th scope="col">Maks. liczba uczest.</th>
                
                    </tr>
                </thead>
                <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                    @forelse ($events as $event)
                        <tr>
                            <td>{{$event->name}}</td>
                            <td>{{$event->description}}</td>
                            <td>{{$event->requiredCategory->name }}</td>
                            <td>{{$event->age_from}}</td>
                            <td>{{$event->age_to}} </td>
                            <td>{{$event->date}} </td>
                            <td>{{$event->start_hour}} </td>
                            <td>{{$event->max_participants}}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="6">Brak zawodów do wyświetlenia.</th>
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


