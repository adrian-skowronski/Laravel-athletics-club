<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;

class EventUserController extends Controller
{
    public function index()
    {
        $eventUsers = EventUser::with('event', 'user')->paginate(5);
    
        $now = Carbon::now();
        
        foreach ($eventUsers as $eventUser) {
            $eventDate = Carbon::parse($eventUser->event->date);
            $eventUser->canRemove = $now->lt($eventDate);
            $eventUser->canAssignPoints = $now->gt($eventDate);
            $eventUser->points = $eventUser->points; 
        }
    
        return view('event-user.index', compact('eventUsers'));
    }
    


    public function edit($event_user_id)
    {
        $eventUser = EventUser::findOrFail($event_user_id);
        $events = Event::all();
        $users = User::all();
        return view('event-user.edit', compact('eventUser', 'events', 'users'));
    }

    public function update(Request $request, $event_user_id)
{
    $eventUser = EventUser::findOrFail($event_user_id);

    $user = User::findOrFail($request->user_id);


    $request->validate([
        'event_id' => 'required|exists:events,event_id',
        'user_id' => 'required|exists:users,user_id',
        'points' => 'required|integer',
    ]);

    $newPoints = $user->points + $request->points;

    $user->update(['points' => $newPoints]);

    $eventUser->update([
        'event_id' => $request->event_id,
        'user_id' => $request->user_id,
        'points' => $request->points,
    ]);

    return redirect()->route('event-user.index')->with('success', 'Przypisanie zaktualizowane.');
}

public function destroy($event_user_id)
{
    $eventUser = EventUser::findOrFail($event_user_id);

    $now = Carbon::now();
    $eventDate = Carbon::parse($eventUser->event->date);

    if ($now->gte($eventDate)) {
        return redirect()->route('event-user.index')->with('error', 'Akcja niedostępna, nie można wypisać zawodnika w dniu zawodów lub po.');
    }

    $eventUser->delete();

    return redirect()->route('event-user.index')->with('success', 'Przypisanie usunięte.');
}

    public function selectEvent()
    {
        $events = Event::where('date', '>', now())->get();
        return view('event-user.select_event', compact('events'));
    }

    public function selectAthletes($event_id)
{
    $event = Event::findOrFail($event_id);
    $athletes = User::where('role_id', 3)
    ->where('category_id', '>=', $event->required_category_id)
    ->get();
    return view('event-user.select_athletes', compact('athletes', 'event'));
}



    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,user_id', 
        ]);

        $event = Event::findOrFail($request->event_id);
        $currentParticipants = EventUser::where('event_id', $request->event_id)->count();
    
        $now = Carbon::now();
        $eventStart = Carbon::parse($event->date)->startOfDay();
        
        if ($now->gte($eventStart)) {
            return redirect()->route('event-user.index')->with('error', 'Minął czas na zapisanie się na wydarzenie.');
        }

        if ($currentParticipants + count($request->user_id) > $event->max_participants) {
            return redirect()->route('event-user.index')->with('error', 'Brak miejsc na wydarzenie.');
        }

        foreach ($request->user_id as $userId) {

            $user = User::findOrFail($userId);
            $age = Carbon::parse($user->birthdate)->age;
            
            if ($age < $event->age_from || $age > $event->age_to) {
                return redirect()->route('event-user.index')->with('error', 'Użytkownik nie spełnia wymaganego przedziału wiekowego.');
            }
    
            $existingEntry = EventUser::where('event_id', $request->event_id)
                                      ->where('user_id', $userId)
                                      ->exists();
    
            if ($existingEntry) {
                return redirect()->route('event-user.index')->with('error', 'Zawodnik jest już zapisany na to wydarzenie.');
            }
    
            EventUser::create([
                'event_id' => $request->event_id,
                'user_id' => $userId,
            ]);
        }
    
        return redirect()->route('event-user.index')->with('success', 'Zapisano uczestników na wydarzenie.');
    }
    }
