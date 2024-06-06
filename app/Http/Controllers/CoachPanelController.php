{{-- coach/panel.blade.php --}}
@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Trenera'])

<body>
    @include('shared.navbar')
    <div class="container mt-4">
        <h2>Twoje Treningi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nazwa Treningu</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->name }}</td>
                    <td>{{ $training->date }}</td>
                    <td>{{ $training->date < now() ? 'Archiwalna' : 'Przyszłe' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('shared.footer')
</body>
