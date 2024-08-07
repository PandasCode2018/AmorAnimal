<?php

namespace App\Http\Controllers;

use App\Models\query_status;
use App\Http\Requests\Storequery_statusRequest;
use App\Http\Requests\Updatequery_statusRequest;

class QueryStatusController extends Controller
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
    public function store(Storequery_statusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(query_status $query_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(query_status $query_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatequery_statusRequest $request, query_status $query_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(query_status $query_status)
    {
        //
    }
}
