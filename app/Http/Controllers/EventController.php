<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Training;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(5);
        return view('events.index', compact('events'));
    }

    public function view()
    {
        $events = Event::paginate(5);
        return view('events.view', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'age_from' => 'required|integer|min:0',
            'age_to' => 'required|integer|min:' . $request->input('age_from'),
            'description' => 'required|string|max:500',
            'date' => 'required|date',
            'start_hour' => 'required',
            'max_participants' => 'required|integer|min:3',
        ]);

        if ($this->checkDateConflict($validatedData['date'])) {
            return redirect()->back()->withErrors(['date' => 'W tym dniu jest już zaplanowany trening.'])->withInput();
        }

        Event::create($validatedData);
        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $event_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'category' => 'required|string|max:255',
            'age_from' => 'required|integer|min:0',
            'age_to' => 'required|integer|min:' . $request->input('age_from'),
            'description' => 'required|string|max:500',
            'date' => 'required|date',
            'start_hour' => 'required',
            'max_participants' => 'required|integer|min:3',
        ]);

        if ($this->checkDateConflict($validatedData['date'])) {
            return redirect()->back()->withErrors(['date' => 'W tym dniu jest już zaplanowany trening.'])->withInput();
        }

        $event = Event::findOrFail($event_id);
        $event->update($validatedData);
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }

    private function checkDateConflict($date)
    {
        return Training::where('date', $date)->exists();
    }

    public function register(Request $request, $event_id)
    {
        $user = Auth::user();
        $event = Event::findOrFail($event_id);

        // Sprawdź, czy użytkownik spełnia wymagania kategorii
        if ($user->category_id < $event->required_category_id) {
            return redirect()->back()->withErrors(['error' => 'Sportowiec nie spełnia wymagań kategorii dla tego wydarzenia.']);
        }

        // Zapisz użytkownika na wydarzenie
        $event->users()->attach($user->user_id);

        return redirect()->back()->with('success', 'Sportowiec został zapisany na wydarzenie.');
    }
}
