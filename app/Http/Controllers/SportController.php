<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::all();
        return view('sports.index', compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
        ]);
        
        Sport::create($request->all());
        return redirect()->route('sports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        return view('sports.edit', compact('sport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sport_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $sport = Sport::findOrFail($sport_id);
        $sport->update($request->all());

        return redirect()->route('sports.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        $sport->delete();
        return redirect()->route('sports.index');
    }
}
