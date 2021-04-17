<?php

namespace App\Http\Controllers\CRM;

use App\Models\BlogSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.blogsubcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blogsubcategory.create');
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
     * @param  \App\Models\BlogSubCategory  $blogSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogSubCategory $blogSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogSubCategory  $blogSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogSubCategory $blogSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogSubCategory  $blogSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogSubCategory $blogSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogSubCategory  $blogSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogSubCategory $blogSubCategory)
    {
        //
    }
}