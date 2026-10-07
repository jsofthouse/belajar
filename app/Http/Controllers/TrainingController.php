<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Http\Requests\TrainingRequest;

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
    public function store(TrainingRequest $request)
    {
        //
        $validated = $request->validated();
        Training::create($validated);
        return redirect()->route('trainings.index')->with('success', 'Training berhasil dibuat.');
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
    public function edit(Training $training)
    {
        //
        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }
        return view('trainings.edit', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainingRequest $request, Training $training)
    {
        //
        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }
        $validated = $request->validated();
        $training->update($validated);
        return redirect()->route('trainings.index')->with('success', 'Training berhasil diperbarui.');
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
