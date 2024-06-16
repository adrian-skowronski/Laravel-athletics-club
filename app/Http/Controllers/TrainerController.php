<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
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
        $trainings = Training::where('trainer_id', auth()->user()->user_id)->paginate(10);
        return view('trainer.index', compact('trainings', 'age'));
    }

    public function viewParticipants($training_id)
    {
        $training = Training::with(['users' => function($query) use ($training_id) {
            $query->select('users.*', 'training_user.status', 'training_user.points')
                ->join('training_user as tu', function($join) use ($training_id) {
                    $join->on('users.user_id', '=', 'tu.user_id')
                         ->where('tu.training_id', '=', $training_id);
                });
        }])->findOrFail($training_id);

        return view('trainer.participants', compact('training'));
    }

    public function editStatus($training_id, $user_id)
{
    $training = Training::findOrFail($training_id);
    $user = User::findOrFail($user_id);
    $maxPoints = $training->max_points;

    return view('trainer.editStatus', compact('training', 'user', 'maxPoints'));
}

public function updateStatus(Request $request, $training_id, $user_id)
{
    $maxPoints = Training::findOrFail($training_id)->max_points;

    $request->validate([
        'status' => 'required|string|in:obecność,nieobecność',
        'points' => 'required|integer|max:'.$maxPoints,
    ]);

    $trainingUser = DB::table('training_user')
        ->where('training_id', $training_id)
        ->where('user_id', $user_id)
        ->first();

    if ($trainingUser) {
        $newPoints = $trainingUser->points + $request->points;

        DB::table('training_user')
            ->where('training_id', $training_id)
            ->where('user_id', $user_id)
            ->update([
                'status' => $request->status,
                'points' => $newPoints,
            ]);

        return redirect()->route('trainer.viewParticipants', $training_id)->with('success', 'Status zaktualizowany.');
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', 
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
}

