<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Requests\V1\SignUpRequest;
use App\Http\Requests\V1\LoginRequest;

class AuthController extends Controller {
    public function register(SignUpRequest $request) {
        $user = User::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'phonenumber' => $request['phonenumber'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken("mytoken", ["create", "update", "delete"])->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(LoginRequest $request) {
        $user = User::with('images')->where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials!!'
            ], 401);
        }

        $token = $user->createToken("mytoken")->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function recover(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request['email'])->first();

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
