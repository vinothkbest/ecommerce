<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Models\RequestCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestCategories=RequestCategory::where('vendor_id', Auth::guard('vendor')->id())->get();
        return view('vendor.pages.requestCategories.index', compact('requestCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.pages.requestCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $requestCategory=new RequestCategory;
        $requestCategory->vendor_id=Auth::guard('vendor')->id();
        $requestCategory->name=$request->name;
        $requestCategory->description=$request->description;
        $requestCategory->status=2;
        $requestCategory->save();
        return redirect()->route('vendor.categories.index')->with(['status' => 'success', 'message' => 'Requested successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RequestCategory $requestCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestCategory $requestCategory)
    {
        return view('vendor.pages.requestCategories.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestCategory $requestCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestCategory  $requestCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestCategory $requestCategory)
    {
        //
    }
}
