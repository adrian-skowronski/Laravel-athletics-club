@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Sportowca'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <div class="user-info mb-5">
        <div class="row">
        <div class="col-sm">
            <h1>Twoje dane</h1>
            <ul>
                <li><strong>Imię:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Nazwisko:</strong> {{ Auth::user()->surname }}</li>
                <li><strong>Data urodzenia:</strong> {{ Auth::user()->birthdate }} (wiek: {{ $age }} l.)</li>
                <li><strong>Telefon:</strong> {{ Auth::user()->phone }}</li>
                <li><strong>Sport:</strong> {{ Auth::user()->sport->name }}</li>
            </ul>

            <div class="container">
                <a href="{{ route('athlete.edit') }}" class="btn btn-primary">Edytuj dane</a>
            </div>
        </div>

        <div class="col-sm">
    @if(Auth::user()->photo)
        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" class="user-photo">
    @else
        <div class="mt-5">
            <i>Brak wgranego zdjęcia użytkownika.</i>
        </div>
    @endif
</div>

<div class="col-sm"></div>
</div>
<div class="mt-5">
        <h2>Twoje treningi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Start</th>
                    <th>Koniec</th>
                    <th>Trener</th>
                    <th>Status</th>
                    <th>Otrzymane punkty</th>
                    <th>Wypisz się</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->date }}</td>
                    <td>{{ $training->start_time }}</td>
                    <td>{{ $training->end_time }}</td>
                    <td>{{ $training->trainer_name }} {{ $training->trainer_surname }}</td>
                    <td>{{ $training->status }}</td>
                    <td>{{ $training->points }}</td>
                    <td>
                    @if(!Carbon\Carbon::parse($training->date . ' ' . $training->end_time)->lt(Carbon\Carbon::now()))
                    <form method="POST" action="{{ route('athlete.removeTraining') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="training_id" value="{{ $training->training_id }}">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz się wypisać z treningu?')">Wypisz się</button>
                </form>
    @else
    Nie można wypisać

    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $trainings->links('pagination::bootstrap-4') }}
            </div>

        <h2 class="mt-5">Twoje zawody</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Godzina</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->start_hour }}</td>             
                   </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-2">
            {{ $events->links('pagination::bootstrap-4') }}
            </div> 

        <h2 class="mt-5">Twoje statystyki</h2>
        <ul>
            <li>Liczba treningów z obecnością: {{ $total_trainings }}</li>
            <li>Łączny czas spędzony na treningach: {{ $total_time }}h</li>
            <li>Ostatni trening z obecnością: 
                @if ($last_training)
                {{ $last_training->description }} |
                Data treningu: {{ $last_training->date }} |
                Status: {{ $last_training->status }} | 
                Punkty: {{ $last_training->points }}
                @else
                Brak danych
                @endif
            </li>
            <li>Liczba punktów zdobytych w bieżącym miesiącu: {{ $total_points_last_month }}</li>
        </ul>

        <div class="container mt-5">
    <div class="row">
    <div class="col-md-6">
        <div class="chart-container h-100 w-100 position-relative">
            <canvas id="timeSpentChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-container h-100 w-100 position-relative">
            <canvas id="trainingCountChart"></canvas>
        </div>
    </div>
</div>

</div>
</div>
</div>
</div>


    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pierwszy wykres: Średni czas na treningu
var timeSpentCtx = document.getElementById('timeSpentChart').getContext('2d');
var timeSpentData = @json($trainingData);

var timeSpentLabels = timeSpentData.map(function(data) {
    return data.date;
}).reverse();;

var timeSpentValues = timeSpentData.map(function(data) {
    return data.average_time; 
}).reverse();;

new Chart(timeSpentCtx, {
    type: 'line',
    data: {
        labels: timeSpentLabels,
        datasets: [{
            label: 'Średni czas na treningu (godziny)',
            data: timeSpentValues,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 0.5
                }
            }
        }
    }
});


            // Drugi wykres: Liczba treningów w miesiącu
            var trainingCountCtx = document.getElementById('trainingCountChart').getContext('2d');
            var trainingCountLabels = {!! json_encode($labels) !!};
            var trainingCountData = {!! json_encode($trainingCounts) !!};

            new Chart(trainingCountCtx, {
                type: 'bar',
                data: {
                    labels: trainingCountLabels,
                    datasets: [{
                        label: 'Liczba treningów z obecnością w miesiącu',
                        data: trainingCountData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                            }
                        }
                    }
                }
            });
        });
    </script>

    @include('shared.footer')
</body>
</html>
