<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

     public function view()
    {
        $events = Event::all();
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
        'category' => 'nullable|string|max:255',
        'age_from' => 'nullable|integer|min:0',
        'age_to' => 'nullable|integer|min:' . $request->input('age_from'),
        'description' => 'nullable|string|max:500',
        'date' => 'required|date',
        'start_hour' => 'required',
        ]);

        Event::create($request->all());
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
        'category' => 'nullable|string|max:255',
        'age_from' => 'nullable|integer|min:0',
        'age_to' => 'nullable|integer|min:' . $request->input('age_from'),
        'description' => 'nullable|string|max:500',
        'date' => 'required|date',
        'start_hour' => 'required',
        ]);

        $event = Event::findOrFail($event_id);

        $event->update($request->all());
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
}
