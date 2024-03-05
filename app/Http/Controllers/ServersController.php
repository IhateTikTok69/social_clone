<?php

namespace App\Http\Controllers;

use App\Models\servers;
use App\Http\Requests\StoreserversRequest;
use App\Http\Requests\UpdateserversRequest;

class ServersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreserversRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(servers $servers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(servers $servers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserversRequest $request, servers $servers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(servers $servers)
    {
        //
    }
}
