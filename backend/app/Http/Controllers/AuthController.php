<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $validated = $request->validate([
            "username" => "required | min:4",
            "password" => "required | min:4",
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect Username Or Password',
            ],Response::HTTP_NOT_FOUND);
        }
        $user = User::select(['id', 'name', 'avatar', 'username', 'email'])->where('username', $validated['username'])->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => "saadasd",//$user->createToken("API TOKEN")->plainTextToken,
            'user' => $user
        ], 200);
    }


    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'min:4|nullable',
            'username' => 'required | min:4 | unique:users',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:4',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Registered Successfully',
            'data' => $user
        ], 200);
    }
}
