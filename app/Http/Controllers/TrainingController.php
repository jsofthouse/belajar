<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Http\Requests\TrainingRequest;
use App\Models\Participant;
use Illuminate\Http\Request;

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
    public function show(Training $training)
    {
        //
        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }
        $registered = $training->participants()->orderBy('name')->get();
        $available = Participant::whereNotIn('id', $registered->pluck('id'))->orderBy('name')->get();
        return view('trainings.show', compact('training', 'registered', 'available'));
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

    public function register(Request $request, Training $training)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
        ]);

        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }

        if ($training->participants()->count() >= $training->quota) {
            return redirect()->route('trainings.show', $training)->with('error', 'Kuota training sudah penuh.');
        }

        if (!$participant = Participant::find($request->participant_id)) {
            return redirect()->route('trainings.show', $training)->with('error', 'Peserta tidak ditemukan.');
        }

        if ($training->participants()->where('participants.id', $participant->id)->exists()) {
            return redirect()->route('trainings.show', $training)->with('error', 'Peserta sudah terdaftar pada training ini.');
        }

        $training->participants()->attach($participant->id);
        return redirect()->route('trainings.show', $training)->with('success', 'Peserta berhasil didaftarkan pada training.');
    }

    public function unregister(Training $training, Participant $participant)
    {
        if (!$training) {
            return redirect()->route('trainings.index')->with('error', 'Training tidak ditemukan.');
        }

        if (!$participant) {
            return redirect()->route('trainings.show', $training)->with('error', 'Peserta tidak ditemukan.');
        }

        if (!$training->participants()->where('participants.id', $participant->id)->exists()) {
            return redirect()->route('trainings.show', $training)->with('error', 'Peserta tidak terdaftar pada training ini.');
        }

        $training->participants()->detach($participant->id);
        return redirect()->route('trainings.show', $training)->with('success', 'Peserta berhasil dihapus dari training.');
    }
}
