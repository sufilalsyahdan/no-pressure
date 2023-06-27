<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use App\Models\Pin;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pin = Pin::where('user_id', Auth::user()->id)->latest()->first();
        $tasks = $pin->tasks;

        return Inertia::render('Pins', [
            'pin' => $pin,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepinRequest $request)
    {
        Pin::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->to('pins');
    }

    public function makeTask(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|max:255',
            'pin_id' => 'required',
        ]);

        if (!$validated) {
            return redirect()->to('pins')->withErrors(['error' => 'Text is required.']);
        }
        
        Task::create([
            'text' => $request->input('text'),
            'priority' => $request->input('priority'),
            'pin_id' => $request->input('pin_id'),
        ]);

        return redirect()->to('pins');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $Pin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $Pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepinRequest  $request
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepinRequest $request, Pin $Pin)
    {
        //
    }

    public function markAsDone(Request $request, Task $Task)
    {
        Task::where('id', $request->id)
            ->update(['is_done' => 1]);

        return redirect()->to('pins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $Pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $Pin)
    {
        //
    }
}
