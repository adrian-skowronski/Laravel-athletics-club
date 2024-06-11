<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/upload/images/' . $user->photo);
            }
    
            // Store new photo
            $path = $request->file('photo')->store('upload/images', 'public');
            
            $user->photo = $path;
            $user->save();
        }
        return redirect()->route('athlete.panel')->with('success', 'Dane zostały zaktualizowane.');
    
}
}
