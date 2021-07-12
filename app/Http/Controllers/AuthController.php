<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'   =>  'No credential match.'
            ], 406);
        }
    
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'user'  =>  $user,
            'token' =>  $token
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message'   =>  'Logged Out!'
        ], 200);
    }
}
