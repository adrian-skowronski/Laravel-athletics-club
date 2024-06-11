@include('shared.html')
@include('shared.head', ['pageTitle' => 'Uczestnicy Treningu'])

<body>
    @include('shared.navbar')
    <div class="container mt-5">
        <h1>Uczestnicy Treningu</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Status</th>
                    <th>Punkty</th>
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                @foreach($training->users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->status }}</td>
                    <td>{{ $user->points }}</td>
                    <td>
                        <a href="{{ route('trainer.editStatus', ['training_id' => $training->training_id, 'user_id' => $user->user_id]) }}" class="btn btn-primary">Zmień status</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('shared.footer')
</body>
</html>
