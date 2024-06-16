<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Sport;
use App\Events\PointsUpdated;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5); 
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $categories = Category::all();
        $sports = Sport::all();
        return view('users.create', compact('roles', 'categories', 'sports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|email|unique:users|max:120',
            'password' => 'required|string|min:8',
            'birthdate' => 'required|date',
            'points' => 'nullable|integer',
            'phone' => 'required|string|max:11|min:9',
            'role_id' => 'nullable|exists:roles,role_id',
            'category_id' => 'nullable|exists:categories,category_id',
            'sport_id' => 'nullable|exists:sports,sport_id',
            'approved' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Użytkownik został pomyślnie dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();
        $categories = Category::all();
        $sports = Sport::all();
        return view('users.edit', compact('user', 'roles', 'categories', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|email|max:120',
            'password' => 'string|min:8',
            'birthdate' => 'required|date',
            'points' => 'nullable|integer',
            'phone' => 'required|string|max:11|min:9',
            'role_id' => 'nullable|exists:roles,role_id',
            'category_id' => 'nullable|exists:categories,category_id',
            'sport_id' => 'nullable|exists:sports,sport_id',
            'approved' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

      
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Dane użytkownika zostały pomyślnie zaktualizowane.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik został pomyślnie usunięty.');
    }
}
