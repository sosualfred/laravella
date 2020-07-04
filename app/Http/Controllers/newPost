<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

// this fetches the model with its namespace 'App' using Eloquent
use App\Post;

//You could also use normal Sql to get these posts
use DB;

class PostsController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return voidboard
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //this returns all the data in our model in a json format
        // $posts = Post::all();

        //Use clause to get a certain post by a certain criteria
        // return Post::where('title', 'Post Two') -> get();


        //Using normal SQL QUERIES
        // $posts = DB::select('SELECT * FROM posts');

        //The most recent post will be the first
        //$posts = Post::orderBy('title', 'desc') ->get();

        //  $posts = Post::orderBy('title', 'desc')->take(1)->get();

        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
            return view('posts.index') -> with('posts', $posts);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Function to add data right from inside our application
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'body' => 'required',
    //         'cover_image' => 'image|nullable|max:1999'
    //     ]);

    //     // Handle File Upload
    //     if($request->hasFile('cover_image')){
    //     //If an file was actually chosen

    //         // Get filename with the extension
    //         $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
    //         // Get just filename
    //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //         // Get just extension
    //         $extension = $request->file('cover_image')->getClientOriginalExtension();
    //         // Filename to store
    //         $fileNameToStore= $filename.'_'.time().'.'.$extension;
    //         // Upload Image
    //         $path = $request->file('cover_image')->storeAs('public/storage/cover_images', $fileNameToStore);
		
	//     //To make thumbnails
	//     $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
    //         $thumb = Image::make($request->file('cover_image')->getRealPath());
    //         $thumb->resize(80, 80);
    //         $thumb->save('storage/cover_images/'.$thumbStore);
		
    //     } else {
    //         //If the user never chooses any file
    //         $fileNameToStore = 'noImage.jpg';
    //     }

    //     // Create Post
    //     $post = new Post;
    //     $post->title = $request->input('title');
    //     $post->body = $request->input('body');
    //     $post->user_id = auth()->user()->id;
    //     $post->cover_image = $fileNameToStore;
    //     $post->save();

    //     return redirect('/posts')->with('success', 'Post Created');
    // }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
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
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		
	    // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('cover_image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/cover_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::find($id);
       return view('posts.show') -> with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::find($id);

       
        //Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')-> with('post', $post);

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //File run when the post is updated
         $this -> validate($request , [
            'title' => 'required',
            'body' => 'required'
        ]);


         // Handle File Upload
         if($request->hasFile('cover_image')){
            //If an file was actually chosen
    
                // Get filename with the extension
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just extension
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            
            // make thumbnails
            // $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            //     $thumb = Image::make($request->file('cover_image')->getRealPath());
            //     $thumb->resize(80, 80);
            //     $thumb->save('storage/cover_images/'.$thumbStore);
            
            } 

        //Find post to be updated
        $post = Post::find($id);
        $post ->title = $request -> input('title');
        $post ->body = $request -> input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post ->save();

        return redirect('/posts') -> with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Method to destroy a given post
        $post= Post::find($id);

        if(auth()-> user()-> id !==$post->user_id){
            return redirect('/posts')-> with('error', 'Unauthorized Page');

        }
        if($post->cover_image!== 'noImage.jpg'){

            //Delete the image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
            
        
        $post ->delete();
        return redirect('/posts') -> with('success', 'Post Deleted Successfully');
    }
}
