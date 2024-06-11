@include('shared.html')
@include('shared.head', ['pageTitle' => 'Panel Trenera'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <h1>Twoje Treningi</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Opis</th>
                    <th>Data</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainings as $training)
                <tr>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->date }}</td>
                    <td>
                        <a href="{{ route('trainer.viewParticipants', $training->training_id) }}" class="btn btn-primary">Pokaż uczestników</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('shared.footer')
</body>
</html>
