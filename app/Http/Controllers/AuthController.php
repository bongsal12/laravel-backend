<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            // 'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'User registered successfully'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = Auth::user();

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
   public function logout(Request $request)
{
    try {

        $token = JWTAuth::parseToken();

        JWTAuth::invalidate($token);

        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully'
        ]);

    } catch (JWTException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to logout, please try again'
        ], 500);
    }
}


    public function me()
    {
       return response()->json(Auth::user());
    }


    // public function refresh()
    // {
    //     return response()->json([
    //         'access_token' => auth()->refresh(),
    //         'token_type' => 'bearer',
    //         'expires_in' => JWTAuth::factory()->getTTL() * 60
    //     ]);
    // }

}
