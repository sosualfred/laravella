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
        //Authorization needed for all pages except, index and posts
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            //User chose an image
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $fileName.'_'.time().'.'.$extension;
            // Upload Image
            $request->file('cover_image')->move('public/cover_images', $fileNameToStore);
        } else {
            //No image chosen
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
        //Check if post exists before deleting
 if (!isset($post)){
    return redirect('/posts')->with('error', 'No Post Found');
}

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

        if($request->hasFile('cover_image')){
            //User chose an image
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $fileName.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
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
        if($post->cover_image != 'noimage.jpg'){

            //Delete the image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }


        $post ->delete();
        return redirect('/posts') -> with('success', 'Post Deleted Successfully');
    }
}
