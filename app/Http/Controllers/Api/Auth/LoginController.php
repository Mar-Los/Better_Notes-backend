<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

// EMAIL VERIFICATION OFF //
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // EMAIL VERIFICATION OFF FOR NOW //
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        return response()->json($user->only(['id', 'email', 'password']));
    }

    public function login(Request $request)
    {
        $creds = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($creds)) {
            return response()->json(['error' => 'incorrect email or password']);
        }

        return response()->json(['token' => $token]);
    }
}
