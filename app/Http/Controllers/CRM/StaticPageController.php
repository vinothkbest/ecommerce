<?php

namespace App\Http\Controllers\CRM;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = StaticPage::get()->groupBy('type')->values();
        //return $pages;
        return view('admin.pages.staticpages.index', compact('pages'));
    }


    public function show($id)
    {
        $staticPage=StaticPage::find($id);
        return view('admin.pages.staticpages.show', compact('staticPage'));
    }
    public function edit($id)
    {
        $staticPage=StaticPage::find($id);
        return view('admin.pages.staticpages.edit', compact('staticPage'));
    }
    public function update(Request $request, $id)
    {
        $staticPage=StaticPage::find($id);
        $staticPage->contents = $request->content;
        $staticPage->save();
        return redirect()->route('admin.staticpages.index')
                        ->with('success', 'Page content updated successfully');
    }
}