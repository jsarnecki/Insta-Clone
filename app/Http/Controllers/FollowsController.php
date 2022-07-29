<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // will run authentication to make sure the user is logged in before running the return on the store method
    }

    public function store(\App\Models\User $user)
    {
        // Toggle: toggles between connected and not conected
        return auth()->user()->following()->toggle($user->profile);
    // Toggling user profile - we toggling the user being passed into this, not the auth user
    // we are toggling whether we are choosing to follow this profile or not, obvs not our own
    // We are just using the auth()->user() to establish the connection
    }


}
