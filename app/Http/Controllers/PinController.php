<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use App\Models\Pin;
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
        $pins = Pin::latest()->get();
        return Inertia::render('Pins', [
            'pins' => $pins
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
        Pin::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->to('pins');
    }

    public function markAsDone(Request $request, Pin $Pin)
    {
        Pin::where('id', $request->id)
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
