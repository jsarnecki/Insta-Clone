<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // Every method within this controller will need authorization
        // Ie: not being able to open /p/create unless signed in
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // Plucks all the user ids out of the current authed user's following profiles

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // whereIn takes a property to find, and an array in which to find it.
        // latest() is a shortened version of the commonly used: orderBy('created_at', 'DESC')
        // paginate: sets how many posts are visible in the index feed before needing to refresh more
        // when paginate is used instead of ->get(), you are able to connect it to frontend with $posts->links() to show links to more pages (tho not working for mine for some reason)
        // ->with('user') is connecting to the Posts model user() method

        return view('posts.index', compact('posts'));
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

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(300, 300);
        $image->save();

        // To authenticate the user, we can post through the user authentication
        //auth()->user()->posts()->create($data); // We could use just the $data obj, but we have to add the imagePath manually
            // user has post() method

        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post) //Having App\Models\Post auto finds the GET $post
    {
        return view('posts.show', compact('post'));
        // Within posts.show (blade file) will show in views, and will have the var 'post' available for use
    }



}
