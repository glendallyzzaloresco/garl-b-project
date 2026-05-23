<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
      public function browseImage()
    {
        return view('browseImage');
    }
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image',
                'title' => 'required|string',
                'content' => 'required|string'
            ]);
            
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(300, 300);
            $filename = time().".jpg";
            $path = public_path('uploads');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $img->toJpeg()->save($path.'/'.$filename);
            
            // Get user ID (use auth()->id() if logged in, otherwise use 1)
            $userId = auth()->check() ? auth()->id() : 1;
            
            // Save to database
            $post = Post::create([
                'user_id' => $userId,
                'title' => $request->title,
                'content' => $request->content,
                'image_path' => $filename
            ]);
            
            if ($post) {
                return back()->with('success', 'Post uploaded successfully!');
            } else {
                return back()->with('error', 'Failed to save post');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }

        
        

      
    } 
}
