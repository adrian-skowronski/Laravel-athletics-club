<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Models\Event;
use App\Models\TrainingUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TrainerController extends Controller
{
    public function index()
    {
        $birthdate = Carbon::parse(Auth::user()->birthdate);
    $age = $birthdate->age;
        $trainings = Training::where('trainer_id', auth()->user()->user_id)->orderBy('date', 'desc')->paginate(10);
        return view('trainer.index', compact('trainings', 'age'));
    }

    public function viewParticipants($training_id)
{
    $training = Training::with(['users' => function($query) {
        $query->withPivot('points', 'status')->paginate(10);
    }])->findOrFail($training_id);

    $users = $training->users()->withPivot('points')->paginate(10);

    return view('trainer.participants', compact('training', 'users'));
}

    public function editStatus($training_id, $user_id)
{
    $trainingUser = TrainingUser::where('training_id', $training_id)
    ->where('user_id', $user_id)
    ->firstOrFail();
    
    $training = Training::findOrFail($training_id);
    $user = User::findOrFail($user_id);
    
    $maxPoints = $training->max_points;

    return view('trainer.editStatus', compact('training', 'user', 'maxPoints', 'trainingUser'));
}

public function updateStatus(Request $request, $training_id, $user_id)
{
    $maxPoints = Training::findOrFail($training_id)->max_points;

    $statusRules = '';
    if ($request->status === 'obecność') {
        $statusRules = 'required|in:obecność';
    } else {
        $statusRules = 'required|in:nieobecność usprawiedliwiona,nieobecność nieusprawiedliwiona';
    }

    $validatedData = $request->validate([
        'status' => $statusRules,
        'points' => [
            'required',
            'integer',
            'min:' . ($request->status === 'obecność' ? '0' : '-5'), // minimalna wartość pkt: 0 dla obecności, -5 dla nieobecności
            'max:' . $maxPoints, 
        ],
    ]);

    $trainingUser = DB::table('training_user')
        ->where('training_id', $training_id)
        ->where('user_id', $user_id)
        ->first();

    if ($trainingUser) {
        $newPoints = $validatedData['points'];

        if ($validatedData['status'] == 'nieobecność usprawiedliwiona') {
            $newPoints = 0;
        } elseif ($validatedData['status'] == 'nieobecność nieusprawiedliwiona') {
            $newPoints = -5;
        }

        DB::table('training_user')
            ->where('training_id', $training_id)
            ->where('user_id', $user_id)
            ->update([
                'status' => $validatedData['status'],
                'points' => $newPoints,
            ]);

        if ($validatedData['status'] == 'obecność') {
            $user = User::findOrFail($user_id);
            $user->points += $newPoints;
            $user->save();
        }

        return redirect()->route('trainer.viewParticipants', $training_id)->with('success', 'Status uczestnika zaktualizowany.');
    }

    return redirect()->route('trainer.viewParticipants', $training_id)->with('error', 'Nie znaleziono uczestnika.');
}


    public function edit()
    {
        $user = Auth::user();
        return view('trainer.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'birthdate' => 'required|date|after_or_equal:1920-01-01',
            'phone' => 'required|string|max:11|min:9',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,

        ]);
       
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/upload/images/' . $user->photo);
            }
                $path = $request->file('photo')->store('upload/images', 'public');
            
            $user->photo = $path;
            $user->save();
        }
        return redirect()->route('trainer.index')->with('success', 'Dane zostały zaktualizowane.');
    
}
public function show($user_id)
{
    $trainer = User::findOrFail($user_id); 
    return view('trainer.details', compact('trainer'));
}


public function createTraining()
{
    return view('trainer.createTraining');
}

public function storeTraining(Request $request)
{
    $request->validate([
        'description' => 'required|string|max:500',
        'date' => 'required|date|after_or_equal:2024-01-01',
        'start_time' => 'required|date_format:H:i',
        'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        'max_points' => 'nullable|integer|min:0|max:200',
    ]);

    $trainer_id = Auth::id();

    if ($this->hasTrainingOnDate($trainer_id, $request->date)) {
        return redirect()->back()->withErrors(['date' => 'W tym dniu masz już zaplanowany trening.'])->withInput();
    }

    $training = new Training();
    $training->description = $request->description;
    $training->date = $request->date;
    $training->start_time = $request->start_time;
    $training->end_time = $request->end_time;
    $training->max_points = $request->max_points;
    $training->trainer_id = $trainer_id;
    $training->save();

    return redirect()->route('trainer.index')->with('success', 'Trening został dodany pomyślnie.');
}


public function trainingEdit($training_id)
    {
        $training = Training::findOrFail($training_id);
        return view('trainer.editTraining', compact('training'));
    }

    public function trainingUpdate(Request $request, $training_id)
{
    $validatedData = $request->validate([
        'description' => 'required|string|max:500',
        'date' => 'required|date|after_or_equal:2024-01-01',
        'start_time' => 'required',
        'end_time' => ['required', 'after:start_time'],
        'max_points' => 'nullable|integer|min:0|max:200',
    ]);

    $trainer_id = Auth::id();

    $currentTraining = Training::findOrFail($training_id);

    if ($currentTraining->date !== $validatedData['date'] && $this->hasTrainingOnDate($trainer_id, $validatedData['date'])) {
        return redirect()->back()->withErrors(['date' => 'W tym dniu masz już zaplanowany trening.'])->withInput();
    }

    $currentTraining->update($validatedData);

    return redirect()->route('trainer.index');
}


    public function trainingDestroy($training_id)
    {
        $training = Training::findOrFail($training_id);
        $training->delete();
        return redirect()->route('trainer.index');
    }

    private function checkDateConflict($date)
    {
        return Event::where('date', $date)->exists();
    }

    public function removeParticipant($training_id, $user_id)
    {
        $participant = TrainingUser::where('training_id', $training_id)->where('user_id', $user_id)->firstOrFail();
        $participant->delete();
        return redirect()->route('trainer.viewParticipants', ['training_id' => $training_id])
            ->with('success', 'Uczestnik został wypisany z treningu.');
    }
    
    private function hasTrainingOnDate($trainer_id, $date)
{
    return Training::where('trainer_id', $trainer_id)
                   ->where('date', $date)
                   ->exists();
}


}

