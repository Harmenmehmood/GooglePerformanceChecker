<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get the authenticated user.
     */
    public function getUser(Request $request)
    {
        // Return the authenticated user data
        return response()->json([
            'user' => $request->user(),  // This will return the logged-in user
        ]);
    }
}
