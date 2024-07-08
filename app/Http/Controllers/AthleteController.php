<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TrainingUser;
use Illuminate\Support\Facades\Gate;

class AthleteController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('athlete.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
'birthdate' => [
            'required',
            'date',
            'after_or_equal:1920-01-01', 
        ],            'phone' => 'required|string|max:11|min:9',
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
        return redirect()->route('athlete.panel')->with('success', 'Dane zostały zaktualizowane.');
    
}

public function removeFromTraining(Request $request)
{
    $user = auth()->user();
    $trainingId = $request->input('training_id');

    $participant = TrainingUser::where('user_id', $user->user_id)
    ->where('training_id', $trainingId)
    ->first();
        
    if (Gate::denies('athlete.removeTraining', $participant)) {
        return redirect()->route('athlete.panel')->with('error', 'Nie masz uprawnień do wypisania się z tego treningu.');
    }

    $participant->delete();

    return redirect()->back()->with('success', 'Wypisano się z treningu.');
}
}
