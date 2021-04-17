<?php

namespace App\Http\Controllers\CRM;

use App\Models\Tag;
use App\Models\SeoList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Helper\BlogClass;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tags = Tag::get();
        return view('admin.pages.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formswap = 'add';
        return view('admin.pages.tag.create', compact('formswap'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->title = ucfirst($request->input('tag-title'));
        $tag->slug = Str::slug($request->input('tag-title'), '-');
        $tag->save();
        
        $seo = new SeoList;
        BlogClass::seo($seo, $request, 'images/seo', $request->file('image'));
        
        $tag = Tag::find($tag->id);
        $tag->TagSeo()->save($seo);

        return redirect()->route('admin.tags.index')->with('success', 'Tag & Its Seo is added sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.pages.tag.detail', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {   $formswap = 'edit';
        return view('admin.pages.tag.create', compact('formswap', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requsetuest
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->title = ucfirst($request->input('tag-title'));
        $tag->slug = Str::slug($request->input('tag-title'), '-');
        $tag->save();
        
        $seo = SeoList::where(['contentable_id'=> $tag->id, 'contentable_type'=>'tag'])->first();
        if ($request->hasFile('image')) {
            $path='images/seo/'.$seo->image;
            if (Storage::disk('local')->exists($path)) {
                Storage::disk('local')->delete($path);
            }
        }
        
        BlogClass::seo($seo, $request, 'images/seo', $request->file('image'));
        $seo->save();
        
        return redirect()->route('admin.tags.index')->with('success', 'Tag & Its Seo is updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function delete($tag)
    {
        $seo = SeoList::where(['contentable_id'=> $tag->id, 'contentable_type'=>'tag'])->first();
        if($seo){
            if($seo->image != NULL){
                $path='images/seo/'.$seo->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
            
            $seo->delete();
        }

        Tag::find($tag)->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag and Its Seo is deleted');
    }

    public function status($tag){
        $tag = Tag::find($tag);
        if($tag->status){
            $tag->status = 0;
            $seo = SeoList::where(['contentable_id'=> $tag->id, 'contentable_type'=>'tag'])->first();
            $seo->status = 0;
            $seo->save();
            $message = 'disabled';
        }
        else{
            $tag->status = 1;
            $seo = SeoList::where(['contentable_id'=> $tag->id, 'contentable_type'=>'tag'])->first();
            $seo->status = 1;
            $seo->save();
            $message = 're-activated';
        }

        $tag->save();
        return redirect()->route('admin.tags.index')->with('success', 'Tag and Its Seo is ' . $message);
    }
}