<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', auth()->user()->id)->with('role')->get();

        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'         =>  'required|unique:users',
            'email'             =>  'required|unique:users',
            'password'          =>  'required|confirmed|min:8',
            'password_confirmation' =>  'required|min:8'
        ]);

        $user = User::create([
            'full_name'     =>  $request->full_name,
            'email'         =>  $request->email,
            'password'      =>  Hash::make($request->password),
            'role_id'       =>  $request->role_id
        ]);

        return response()->json($user, 200);
    }
    
    public function update(Request $request, $userId)
    {
        User::where('id', $userId)
            ->update([
                'full_name'     =>  $request->full_name,
                'email'         =>  $request->email,
                'role_id'       =>  $request->role_id
            ]);

        return response()->json(
            User::where('id', $userId)->with('role')->first()
        , 200);
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return response()->json([
            'message'   =>  'User deleted.'
        ], 200);
    }
}
