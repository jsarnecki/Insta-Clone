<?php

namespace App\Http\Controllers;

use App\Models\User; // Must be imported as User is not in the same namespace as ProfilesController
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(\App\Models\User $user) // \App\Models\User finds the user automagically, so don't need to findOrFail
        // 'index' is simply name of the metho
    {
        // $user = User::findOrFail($user);  // Sends a 404 error if not found
        //
        // return view('profiles.index', [   //Refers to the index.blade.php file within views
        //     // 2nd arg can be an array
        //     'user' => $user,
        // ]);

        return view('profiles.index', compact('user'));
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
        $data = \request()->validate([
           'title'=>'required',
           'description'=>'required',
           'url'=>'url', // Must be a URL - ei expects http://..
           'image'=>'',
        ]);

        auth()->user->profile->update($data);
        // Can update without auth() ei: $user->profile..etc
        // But anyone can access + edit, so auth adds an extra layer of protection

        return redirect("/profile/{$user->id}");
    }
}
