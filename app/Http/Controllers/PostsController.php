<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // Every method within this controller will need authorization
        // Ie: not being able to open /p/create unless signed in
    }


    public function create()
    {
        return view('posts.create');
        // Calls posts.create within views/posts/create, ei when you visit /p (from
    }

    public function store()
    {
        $data = request()->validate([
            // if the fields aren't inside this validate, they will be ignored
            //But you can add 'another'=>'', which will pass in anything else that's not in this arr
            'caption' => 'required',
            'image' => ['required', 'image'], // Adding the 'image' rule allows for only image files to be uploaded
        ]);

        /*
        * This is the tinker way of creating and saving incoming post requests, and is acceptable, tho there's an easier way
        $post = new \App\Models\Post();
        $post->caption = $data['caption'];
        $post->save();
        */

        /*
         * Adding the properties to the arr in create(), or just add the variable created above
        \App\Models\Post::create([
            'caption'=>$data['caption'],
        ]);


        *Like so:
        \App\Models\Post::create($data);

        *But the user_id is needed for authentication, and is not inside the validate(), so we don't know if someone is signed in
        */

        $imagePath = \request('image')->store('uploads', 'public');

        // To authenticate the user, we can post through the user authentication
        //auth()->user()->posts()->create($data); // We could use just the $data obj, but we have to add the imagePath manually
            // user has post() method

        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
}
