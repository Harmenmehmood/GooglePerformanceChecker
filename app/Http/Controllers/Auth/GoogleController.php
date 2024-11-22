<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log; // Import Log facade for logging

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Find or create the user
            $existingUser = User::firstOrCreate(
                ['google_id' => $user->getId()],
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => null, // Explicitly set password to null for Google users
                ]
            );

            // Create a token for the user
            $token = $existingUser->createToken('LaravelAPI')->plainTextToken; // Ensure HasApiTokens is used in the User model

            return response()->json([
                'user' => $existingUser,
                'token' => $token,
            ], 200, ['Content-Type' => 'application/json']);
        } catch (Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return response()->json([
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'An error occurred during login. Please try again.',
            ], 400, ['Content-Type' => 'application/json']);
        }
    }

    
}
