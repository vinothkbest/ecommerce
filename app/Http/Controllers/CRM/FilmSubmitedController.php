<?php

namespace App\Http\Controllers\CRM;

use App\Models\FilmSubmited;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmSubmitedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.filmsubmiteds.index');    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilmSubmited  $filmSubmited
     * @return \Illuminate\Http\Response
     */
    public function show(FilmSubmited $filmSubmited)
    {
        return view('admin.pages.filmsubmiteds.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilmSubmited  $filmSubmited
     * @return \Illuminate\Http\Response
     */
    public function edit(FilmSubmited $filmSubmited)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FilmSubmited  $filmSubmited
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FilmSubmited $filmSubmited)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilmSubmited  $filmSubmited
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilmSubmited $filmSubmited)
    {
        //
    }
}