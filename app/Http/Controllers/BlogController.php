<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.blog.blog_index',[
            'blogs' => Blog::latest()->simplepaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.blog_create',[
            'categories' => Category::orderBy('category_name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog;
        $blog->user_id = Auth::id();
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->featured = $request->featured;
        $blog->keywords = $request->keywords;
        $blog->summary = $request->summary;
        $blog->save();

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blog->id);
            $path = public_path('thumbnail/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $ext);
            $new->thumbnail = $ext;
            $new->save();
        }

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $ext = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Blog::findOrfail($blog->id);
            $path = public_path('featured/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path, $mode= 0777, true, true );
            Image::make($image)->save($path . $ext);
            $new->featured_image = $ext;
            $new->save();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('backend.blog.blog_edit',[
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
