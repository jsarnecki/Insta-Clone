<?php

namespace App\Http\Controllers;

use App\Models\User; // Must be imported as User is not in the same namespace as ProfilesController
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user) // 'index' is simply name of the method
    {
        $user = User::find($user);
        return view('home', [   //Refers to the home.blade.php file within views
            // 2nd arg can be an array
            'user' => $user,
        ]);
    }
}
