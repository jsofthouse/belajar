<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Http\Resources\TrainingResource;
use App\Http\Requests\TrainingRequest;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $trainings = Training::withCount('participants')
            ->search($request->q)
            ->atLocation($request->loc)
            ->status($request->status)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return TrainingResource::collection($trainings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainingRequest $request)
    {
        //
        $training = Training::create($request->validated());
        return (new TrainingResource($training)->response()->setStatusCode(201));
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        //
        return new TrainingResource($training->loadCount('participants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrainingRequest $request, Training $training)
    {
        //
        $training->update($request->validated());
        return (new TrainingResource($training->loadCount('participants'))->response()->setStatusCode(200));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //
        $training->delete();
        return response()->noContent()->setStatusCode(204);
    }
}
