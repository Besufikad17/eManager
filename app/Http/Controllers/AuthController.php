<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phonenumber' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'fname' => $fields['fname'],
            'lname' => $fields['lname'],
            'email' => $fields['email'],
            'phonenumber' => $fields['phonenumber'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken("mytoken")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials!!'
            ], 401);
        }

        $token = $user->createToken("mytoken")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout() {
        // FIXME: tokens() alternative
        // auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
