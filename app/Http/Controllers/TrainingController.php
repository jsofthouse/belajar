<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainings = Training::latest()->paginate(10);
        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:150|min:5',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'held_at' => 'required|date|after:today',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        Training::create($validated);
        return redirect()->route('trainings.index')->with('success', 'Training sudah ditambahkan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //
        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }
        $training->delete();
        return redirect()->route('trainings.index')->with('success', 'Training berhasil dihapus.');
    }
}
