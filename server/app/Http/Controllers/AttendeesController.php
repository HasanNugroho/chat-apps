<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreattendeesRequest;
use App\Http\Requests\UpdateattendeesRequest;
use App\Models\attendees;

class AttendeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreattendeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreattendeesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendees  $attendees
     * @return \Illuminate\Http\Response
     */
    public function show(attendees $attendees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendees  $attendees
     * @return \Illuminate\Http\Response
     */
    public function edit(attendees $attendees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateattendeesRequest  $request
     * @param  \App\Models\attendees  $attendees
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateattendeesRequest $request, attendees $attendees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendees  $attendees
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendees $attendees)
    {
        //
    }
}
