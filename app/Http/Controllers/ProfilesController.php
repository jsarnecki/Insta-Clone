<?php

namespace App\Http\Controllers;

use App\Models\User; // Must be imported as User is not in the same namespace as ProfilesController
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function index(\App\Models\User $user) // \App\Models\User finds the user automagically, so don't need to findOrFail
        // 'index' is simply name of the method
    {
        // $user = User::findOrFail($user);  // Sends a 404 error if not found
        //
        // return view('profiles.index', [   //Refers to the index.blade.php file within views
        //     // 2nd arg can be an array
        //     'user' => $user,
        // ]);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        //Determine how to find out if this user follows that profile so it can be passed to our views
        // Is the auth user following the passed in $user? else return false


        $postCount = Cache::remember(
            'count.posts.' . $user->id, // cache key, adds the $user->id to make it unique
            now()->addSecond(30),  // 2nd arg is how long to store the cache (now+30secs)
            function () use ($user) { // the function doesnt have access to $user, so needs to 'use ($user)'
                return $user->posts->count();
        });

        $followerCount = Cache::remember(
            'follower.count.' .$user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'following.count' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->following->count();
        });

        // Adds caching for the posts/followers/following count so there aren't db queries everytime the page is visited
        // could also use Cache::rememberForever - which does not take a 2nd arg


        return view('profiles.index', compact('user', 'follows', 'postCount', 'followerCount', 'followingCount'));
        // Compact creates an array out of the variable/obj properties passed to it
        // meaning, not needing to pass in all the properties manually

    }

    public function edit(User $user)
    // Instead of passing \App\Models\User we can just pass 'User', as it is imported at the top
    {
        $this->authorize('update', $user->profile);
        // Authorizes 'update' on this $user's profile
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = \request()->validate([
           'title'=>'required',
           'description'=>'required',
           'url'=>'url', // Must be a URL - ei expects http://..
           'image'=>'',
        ]);


        if (\request('image')) {
        //Because an image is not required, this is if one is uploaded
            $imagePath = \request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300, 300);
            $image->save();

            $imageArr = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArr ?? [], // If no img is set, breaks code, so default to empty arr to fix
            // Overrides the 'image' property inside $data with $imagePath
        ));
        // Can update without auth() ei: $user->profile..etc
        // But anyone can access + edit, so auth adds an extra layer of protection

        return redirect("/profile/{$user->id}");
    }
}
