{{-- athlete.panel --}}
@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Sportowca'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <div class="user-info mb-5">
            <h2>Twoje Dane</h2>
            <ul>
                <li><strong>Imię:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Nazwisko:</strong> {{ Auth::user()->surname }}</li>
                <li><strong>Data urodzenia:</strong> {{ Auth::user()->birthdate }} (wiek: {{ $age }} l.)</li>
                <li><strong>Telefon:</strong> {{ Auth::user()->phone }}</li>
                <li><strong>Zdjęcie:</strong> 
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo">
                    @else
                        Brak zdjęcia
                    @endif
                </li>
            </ul>

            <div class="container">
                <a href="{{ route('athlete.edit') }}" class="btn btn-primary">Edytuj Dane</a>
            </div>
        </div>

        <h2>Twoje Treningi</h2>
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
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">Twoje Zawody</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->isPast() ? 'Archiwalna' : 'Przyszłe' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">Twoje statystyki</h2>
        <ul>
            <li>Liczba treningów z obecnością: {{ $total_trainings }}</li>
            <li>Łączny czas spędzony na treningach: {{ $total_time }}h</li>
            <li>Ostatni trening z obecnością: 
                {{ $last_training->description }} |
                Data treningu: {{ $last_training->date }} |
                Status: {{ $last_training->status }} | 
                Punkty: {{ $last_training->points }}
            </li>
            <li>Liczba punktów zdobytych w bieżącym miesiącu: {{ $total_points_last_month }}</li>
        </ul>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                    <canvas id="timeSpentChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                    <canvas id="trainingCountChart"></canvas>
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
            });

            var timeSpentValues = timeSpentData.map(function(data) {
                return data.total_time;
            });

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
                            beginAtZero: true
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
                        label: 'Liczba treningów w miesiącu',
                        data: trainingCountData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    @include('shared.footer')
</body>
</html>
