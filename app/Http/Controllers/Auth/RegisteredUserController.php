<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    
    public function create(): View
    {
        return view('auth.register');
    }

   
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:80'],
        'surname' => ['required', 'string', 'max:80'],
        'phone' => ['required', 'string', 'max:11'],
        'birthdate' => ['required', 'date'],
        'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'phone' => $request->phone,
        'birthdate' => $request->birthdate,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'approved' => false, 
    ]);

    event(new Registered($user));

    return redirect()->route('auth.notice');}

}
