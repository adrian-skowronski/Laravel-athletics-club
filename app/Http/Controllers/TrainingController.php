<?php
namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::with('trainer.sport')->paginate(10);
        return view('trainings.index', compact('trainings'));
    }

    public function view()
    {
        $trainings = Training::with('trainer.sport')->paginate(10); //nie ma problemu N+1 - zapewniono eager loading
        return view('trainings.view', compact('trainings'));
    }

    public function create()
    {
        $trainers = User::where('role_id', 2)->get();
        return view('trainings.create', compact('trainers'));
    }

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

        if ($this->checkDateConflict($validatedData['date'])) {
            return redirect()->back()->withErrors(['date' => 'W tym dniu jest już zaplanowane wydarzenie.'])->withInput();
        }

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
        $validatedData = $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'trainer_id' => 'required|exists:users,user_id',
            'max_points' => 'nullable|integer|min:0',
        ]);

        if ($this->checkDateConflict($validatedData['date'])) {
            return redirect()->back()->withErrors(['date' => 'W tym dniu jest już zaplanowane wydarzenie.'])->withInput();
        }

        $training = Training::findOrFail($training_id);
        $training->update($validatedData);
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

        if (!$this->canSignUpForTraining($user, $training)) {
            return redirect()->route('trainings.view')->with('error', 'Nie możesz zapisać się na ten trening.');
        }

        if ($user->trainings()->where('training_user.training_id', $training_id)->exists()) {
            return redirect()->route('trainings.view')->with('error', 'Jesteś już zapisany na ten trening.');
        }

        $user->trainings()->attach($training_id);
        return redirect()->route('trainings.view')->with('success', 'Zapisano na trening.');
    }

    private function canSignUpForTraining($user, $training)
    {
        return $user->role_id == 3 && $user->sport_id == $training->trainer->sport->sport_id;
    }

    private function checkDateConflict($date)
    {
        return Event::where('date', $date)->exists();
    }
}
