@include('shared.html')
@include('shared.head', ['pageTitle' => 'Rejestracja'])

@include('shared.navbar')

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <br>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Imię')" class="text-black" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required maxlength="80" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Nazwisko')" class="text-black" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required maxlength="80" autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Telefon')" class="text-black" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required pattern="\d{9,11}" title="Telefon musi zawierać od 9 do 11 cyfr" autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adres email')" class="text-black" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required maxlength="150" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Birthdate -->
        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Data urodzenia')" class="text-black"/>
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required autocomplete="birthdate" min="1920-01-01" />
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Hasło')" class="text-black"/>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required minlength="8" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Powtórz hasło')" class="text-black"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Już zarejestrowany?') }}
            </a>

            <x-primary-button class="ms-4 ">
                {{ __('Zarejestruj się') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

@include('shared.footer')
