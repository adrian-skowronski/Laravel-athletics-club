@include('shared.html')
@include('shared.head', ['pageTitle' => 'Zapomniałem hasła'])

@include('shared.navbar')

<x-guest-layout>
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
                    <p class="text-red-500">Przepraszamy, system przypominania hasła jest tymczasowo niedostępny.</p>
                    <br>
                    <p class="text-red-500">Prosimy o kontakt z administratorem serwisu: <b>klub@sokol.pl</b></p>
        </div>
</x-guest-layout>

@include('shared.footer')