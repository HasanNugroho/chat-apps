<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorechatsRequest;
use App\Http\Requests\UpdatechatsRequest;
use App\Models\chats;

class ChatsController extends Controller
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
     * @param  \App\Http\Requests\StorechatsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorechatsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function show(chats $chats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function edit(chats $chats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatechatsRequest  $request
     * @param  \App\Models\chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatechatsRequest $request, chats $chats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chats  $chats
     * @return \Illuminate\Http\Response
     */
    public function destroy(chats $chats)
    {
        //
    }
}
