<?php

namespace App\Http\Controllers;

use App\Models\User; // Must be imported as User is not in the same namespace as ProfilesController
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user) // 'index' is simply name of the method
    {
        $user = User::findOrFail($user);  // Sends a 404 error if not found

        return view('profiles.index', [   //Refers to the index.blade.php file within views
            // 2nd arg can be an array
            'user' => $user,
        ]);
    }
}
