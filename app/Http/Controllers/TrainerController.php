<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    public function index()
    {
        $trainings = Training::where('trainer_id', auth()->user()->user_id)->get();
        return view('trainer.index', compact('trainings'));
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
        return view('trainer.editStatus', compact('training', 'user'));
    }

    public function updateStatus(Request $request, $training_id, $user_id)
    {
        $maxPoints = Training::findOrFail($training_id)->max_points;

        $request->validate([
            'status' => 'required|string|in:obecność,nieobecność',
            'points' => 'required|integer|max:'.$maxPoints,
        ]);

        DB::table('training_user')
            ->where('training_id', $training_id)
            ->where('user_id', $user_id)
            ->update([
                'status' => $request->status,
                'points' => $request->points,
            ]);

        return redirect()->route('trainer.viewParticipants', $training_id)->with('success', 'Status zaktualizowany.');
    }
}
