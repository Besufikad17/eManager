<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
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

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::with('images')->where('email', $fields['email'])->first();

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

    public function recover(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request['email'])->first();

        echo $user;
        if($user) {
            $code = VerificationCode::create([
                'user_id' => $user["id"],
                'code' => Str::random(8),
                'expired' => false
            ]);

            // TODO: send email

            return $code;
        } else {
            return response([
                'message' => 'User not found!!'
            ], 401);
        }
    }



    public function logout() {
        // FIXME: tokens() alternative
        // auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
