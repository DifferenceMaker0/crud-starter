<?php

namespace App\Http\Controllers;
use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Str;

/* Spatie Html JS Insertion */
use Spatie\Html\Elements;
use Spatie\Html\HtmlServiceProvider;  
/*  */
use Illuminate\Support\Facades\File;
/* Intervention Laravel-Html or ImageManager */
use Intervention\Image\Laravel\Facades\Image;
/* ImageManager Resize Proportional */
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PostsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all(); 
        // $cover_image = $posts->cover_image;
        $paginate = Posts::paginate(1); 
        return view('posts.index', compact('paginate', 'posts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('posts.create'); 
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);  
        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
                

            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;  
            // Upload Image
            $path = $request->file('cover_image')->storeAs('original', $fileNameToStore); 

            $cover_image = $request->file('cover_image'); 
            $tn = Image::read($cover_image)->resize(80, 80);
            $randomizer = Str::random() . '.' . $cover_image->getClientOriginalExtension();
            $thumbnailer = $tn->encodeByExtension($cover_image->getClientOriginalExtension(), quality:70);
            Storage::put('thumbnails/'.$randomizer, $thumbnailer);  
            } else {
                $fileNameToStore = 'noimage.png';
                $randomizer = 'noimage.jpg';
            } 
$post = new Posts;
$post->cover_image = $fileNameToStore;
$post->thumbnail = $randomizer;
$post->original_filename = $filenameWithExt;
$post->title = $request->input('title');
$post->body = $request->input('body'); 
$post->user_id = auth()->user()->id;
$post->save(); 
// $post->cover_image = $fileNameToStore;  
 }   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $post = Posts::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function read(string $id)
    {
        $posts = Posts::all();  
        $postIds = $posts->pluck('id');  
        $postIdsArray = $posts->pluck('id')->toArray();
        $post = Posts::find($id);
        $icon = html()->span()->class('fa'); 

        return view('posts.read', compact('posts', 'post', 'postIds', 'postIdsArray', 'icon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Posts::find($id);
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }   
            // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        } 
        return view('posts.edit')->with('post', $post); 
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]); 
        $post = Posts::find($id);
         // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            // Delete file if exists
            Storage::delete('public/cover_images/'.$post->cover_image);
		
	   //Make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('cover_image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/cover_images/'.$thumbStore);
		
        }

        // Update Post
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Posts::find($id);
        
        //Check if post exists before deleting
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    } 

}
