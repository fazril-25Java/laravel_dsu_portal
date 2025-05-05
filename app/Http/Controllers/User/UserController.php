<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function profile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('user.profile', compact('user')); // Pass user data to the view
    }
}
