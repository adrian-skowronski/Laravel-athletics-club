<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::with('trainer.sport')->get();
        return view('trainings.index', compact('trainings'));
    }

   
    public function view()
    {
        $trainings = Training::with('trainer.sport')->get(); //nie ma problemu N+1 - zapewniono eager loading
        return view('trainings.view', compact('trainings'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pobierz listę trenerów
        $trainers = User::where('role_id', 2)->get();
        return view('trainings.create', compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:200',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'trainer_id' => 'required|exists:users,user_id',
            'max_points' => 'nullable|integer|min:0',
        ]);

        Training::create($validatedData);

        return redirect()->route('trainings.index');
    }

    public function edit($training_id)
    {
        $training = Training::findOrFail($training_id);
        $trainers = User::where('role_id', 2)->get(); 
        return view('trainings.edit', compact('training', 'trainers'));
    }

    public function update(Request $request, $training_id)
{
    $request->validate([
        'description' => 'required|string',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'trainer_id' => 'required|exists:users,user_id',
        'max_points' => 'nullable|integer|min:0',
    ]);

    $startTime = $request->input('start_time');
    $endTime = $request->input('end_time');

    if (strtotime($endTime) <= strtotime($startTime)) {
        return redirect()->back()->withErrors(['end_time' => 'Godzina zakończenia musi być późniejsza od godziny rozpoczęcia.'])->withInput();
    }

    
    $training = Training::findOrFail($training_id);
    $training->update($request->all());

    return redirect()->route('trainings.index');
}


    
    public function destroy($training_id)
    {
        $training = Training::findOrFail($training_id);
        $training->delete();

        return redirect()->route('trainings.index');
    }

    public function signUp($training_id)
{
    $user = Auth::user();

    $training = Training::findOrFail($training_id);
    if ($user->sport_id != $training->trainer->sport->sport_id) {
        return redirect()->route('trainings.index')->with('error', 'Nie możesz zapisać się na ten trening.');
    }
    if ($user->trainings()->where('training_user.training_id', $training_id)->exists()) {
        return redirect()->route('trainings.index')->with('error', 'Jesteś już zapisany na ten trening.');
    }

    $user->trainings()->attach($training_id);

    return redirect()->route('trainings.index')->with('success', 'Zapisano na trening.');
}
}
