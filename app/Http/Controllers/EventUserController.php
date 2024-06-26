<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser;
use App\Models\User;
use App\Models\Event;

class EventUserController extends Controller
{
    public function index()
    {
        $eventUsers = EventUser::with('event', 'user')->paginate(10);
        return view('event_user.index', compact('eventUsers'));
    }

    public function edit($id)
    {
        $eventUser = EventUser::findOrFail($id);
        $events = Event::all();
        $users = User::all();
        return view('event_user.edit', compact('eventUser', 'events', 'users'));
    }

    public function update(Request $request, $id)
    {
        $eventUser = EventUser::findOrFail($id);

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer',
        ]);

        $eventUser->update([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'points' => $request->points,
        ]);

        return redirect()->route('event_user.index')->with('success', 'Przypisanie zaktualizowane.');
    }

    public function destroy($id)
    {
        $eventUser = EventUser::findOrFail($id);
        $eventUser->delete();

        return redirect()->route('event_user.index')->with('success', 'Przypisanie usunięte.');
    }

    public function eligibleAthletes(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $athletes = User::where('category_id', '>=', $event->required_category_id)->get();
        $events = Event::where('date', '>', now())->get();

        return view('event_user.create', compact('events', 'athletes', 'event'))->with('selected_event', $event);
    }

    public function create()
{
    $events = Event::where('date', '>', now())->get();
    return view('event_user.create', compact('events'));
}

public function store(Request $request)
{
    
    $request->validate([
        'event_id' => 'required|exists:events,event_id',
        'user_id' => 'required|exists:users,user_id', 
    ]);
    
    EventUser::create([
        'event_id' => $request->event_id,
        'user_id' => $request->user_id,
    ]);

    

    return redirect()->route('event_user.index')->with('success', 'Przypisanie dodane.');
}

public function show()
{
    dd();
}
}
