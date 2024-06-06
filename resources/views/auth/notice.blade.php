@include('shared.html')
@include('shared.head', ['pageTitle' => 'Oczekiwanie na weryfikację'])
@include('shared.navbar')
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="alert alert-warning text-center" role="alert" style="display: inline-block; width: auto;">
        Twoje konto czeka na weryfikację przez administratora.
    </div>
    <a href="{{ route('start.index') }}" class="btn btn-primary mt-3" style="width: auto;">Powrót do strony głównej</a>
</div>
@include('shared.footer')

