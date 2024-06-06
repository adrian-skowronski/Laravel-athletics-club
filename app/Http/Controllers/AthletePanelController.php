<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AthletePanelController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $trainings = DB::table('training_user')
            ->join('trainings', 'training_user.training_id', '=', 'trainings.training_id')
            ->where('training_user.user_id', $user->id)
            ->select('trainings.*')
            ->get();

        $events = DB::table('event_user')
            ->join('events', 'event_user.event_id', '=', 'events.event_id')
            ->where('event_user.user_id', $user->id)
            ->select('events.*')
            ->get();

        return view('athlete.index', compact('trainings', 'events'));
    }
}
