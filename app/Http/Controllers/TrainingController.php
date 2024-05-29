<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::with('trainer')->get();
        return view('trainings.index', compact('trainings'));
    }

   

    public function view()
    {
        $trainings = Training::with('trainer')->get();
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
        'start_time' => 'required|date_format:HH:ii', 
        'end_time' => 'required|date_format:HH:ii|gt:start_time', 
        'trainer_id' => 'required|exists:users,user_id',
    ]);

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
}
