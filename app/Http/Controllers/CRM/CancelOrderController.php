<?php

namespace App\Http\Controllers\CRM;

use App\Models\CancelOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CancelOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.cancelorder.index');
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
     * @param  \App\Models\CancelOrder  $cancelOrder
     * @return \Illuminate\Http\Response
     */
    public function show(CancelOrder $cancelOrder)
    {
        return view('admin.pages.cancelorder.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CancelOrder  $cancelOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(CancelOrder $cancelOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CancelOrder  $cancelOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CancelOrder $cancelOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancelOrder  $cancelOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancelOrder $cancelOrder)
    {
        //
    }
}