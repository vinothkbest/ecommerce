<?php

namespace App\Http\Controllers\CRM;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\SeoList;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Category as CategoryResource;
use Str;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Helper\BlogClass;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderByDesc("updated_at")->get();
        return view('admin.pages.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formswap = 'add';
        $tags = Tag::get();
        return view('admin.pages.post.create', compact('formswap', 'tags'));
    }

    public function chooseSubCategory($category_id){
        $categories = Category::where('parent_id', $category_id)->get();
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->admin_id = Auth::id();
        $post->title = ucfirst($request->input('blog-title'));
        $post->slug = Str::slug($request->input('blog-title'), '-');
        if ($request->hasFile('blog-image')) {
            BlogClass::image($post, $request->file('blog-image'), 'images/posts');
        }
        $post->description = $request->input('blog-content');
        $post->save();

        $seo = new SeoList;
        BlogClass::seo($seo, $request, 'images/seo', $request->file('image'));
        $post = Post::find($post->id);
        if(!empty($request->tags)){
            $post->tags()->sync($request->tags);
        }
        
        if($request->has('last_sub_category') && $request->last_sub_category != "no"){
            $categories = [intval($request->category), intval($request->sub_category),intval($request->last_sub_category)];
            
        }
        if($request->has('sub_category') && $request->sub_category != "no" && !$request->has('last_sub_category') || $request->last_sub_category == "no"){
            $categories = [intval($request->category), intval($request->sub_category)];

            
        }
        if($request->category != "" && !$request->has('sub_category') || $request->sub_category == "no"){
            $categories = [intval($request->category)];
            
        }

        if(!empty($categories) && $request->category != "no"){
            $post->categories()->sync($categories);
        }
        elseif($request->category == "no" && $request->category != ""){
            $post->categories()->sync([]);
        }

        $post->postSeo()->save($seo);

        return redirect()->route('admin.posts.index')->with('success', 'Post & Its Seo is added sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::find($post);
        return view('admin.pages.post.detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $formswap = 'update';
        $tags = Tag::get();
        $post = Post::find($post);
        return view('admin.pages.post.create', compact('formswap', 'post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $post = Post::find($post);

        $post->admin_id = Auth::id();
        $post->title = ucfirst($request->input('blog-title'));
        $post->slug = Str::slug($request->input('blog-title'), '-');
        if ($request->hasFile('blog-image') ) {
            if($post->image){

                $path='images/posts/'.$post->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                    
                }
            }
            BlogClass::image($post, $request->file('blog-image'), 'images/posts');
        }
        
        $post->description = $request->input('blog-content');
        $post->save();

        $seo = SeoList::where(['contentable_id'=> $post->id, 'contentable_type'=>'post'])->first();
        if ($request->hasFile('image')) {
            if($seo->image){
                $path='images/seo/'.$seo->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
        }
        
        BlogClass::seo($seo, $request, 'images/seo', $request->file('image'));
        $post = Post::find($post->id);
        if(!empty($request->tags)){
            $post->tags()->sync($request->tags);
        }
        
        if($request->has('last_sub_category') && $request->last_sub_category != "no"){
            $categories = [intval($request->category), intval($request->sub_category),intval($request->last_sub_category)];
            
        }
        if($request->has('sub_category') && $request->sub_category != "no" && !$request->has('last_sub_category') || $request->last_sub_category == "no"){
            $categories = [intval($request->category), intval($request->sub_category)];

            
        }
        if($request->category != "" && !$request->has('sub_category') || $request->sub_category == "no"){
            $categories = [intval($request->category)];
            
        }

        if(!empty($categories) && $request->category != "no"){
            $post->categories()->sync($categories);
        }
        elseif($request->category == "no" && $request->category != ""){
            $post->categories()->sync([]);
        }

        $post->postSeo()->save($seo);

        return redirect()->route('admin.posts.index')->with('success', 'Post & Its Seo is updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($post)
    {
        $seo = SeoList::where(['contentable_id'=> $post, 'contentable_type'=>'post'])->first();
        if($seo){
            if($seo->image != NULL){
                $path='images/seo/'.$seo->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
            
            $seo->delete();
        }

        $post = Post::find($post);
        if($post){
            if($post->image != NULL){
                $path='images/posts/'.$post->image;
                if (Storage::disk('local')->exists($path)) {
                    Storage::disk('local')->delete($path);
                }
            }
            $post->tags()->detach();
            $post->categories()->detach();
            $post->delete();
        }
       
        return redirect()->route('admin.posts.index')->with('success', 'Post and Its Seo is deleted');

    }

    public function status($post){
        $post = Post::find($post);
        if($post->status){
            $post->status = 0;
            $seo = SeoList::where(['contentable_id'=> $post->id, 'contentable_type'=>'post'])->first();
            $seo->status = 0;
            $seo->save();
            $message = 'disabled';
        }
        else{
            $post->status = 1;
            $seo = SeoList::where(['contentable_id'=> $post->id, 'contentable_type'=>'post'])->first();
            $seo->status = 1;
            $seo->save();
            $message = 're-activated';
        }

        $post->save();
        return redirect()->route('admin.posts.index')->with('success', 'Post and Its Seo is ' . $message);
    }
}