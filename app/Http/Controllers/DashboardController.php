<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;


/* Intervention Laravel-Html or ImageManager */
use Intervention\Image\Laravel\Facades\Image;
/* ImageManager Resize Proportional */
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use Illuminate\Support\Facades\File;


class DashboardController extends Controller
{  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to your desired page after logout
    }

    public function resize(Request $request)
    {
        $validated = $request->validate([  
            'image' => 'image|nullable|max:1999',
        ]);   

$manager = new ImageManager(new Driver()); 
// create new image instance with 800 x 600 (4:3)
$image = $manager->read('images/example.jpg');

// scale to fixed height
$image->scale(height: 300); // 400 x 300 (4:3)

// scale to 120 x 100 pixel
$image->scale(120, 100); // 120 x 90 (4:3)
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


return redirect('/posts')->with('success', 'Post Created'); 
 }   


}