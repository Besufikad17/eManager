<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\MailController;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\PasswordRecoveryRequest;
use App\Http\Requests\V1\SignUpRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function recover(PasswordRecoveryRequest $request) {
        $user = User::where('email', $request['email'])->first();

        if(isset($user)){
            $code = VerificationCode::create([
                'user_email' => $request['email'],
                'code' => Str::random(8),
                'expired' => false,
                'verified' => false
            ]);

            $mailController = new MailController();
            $mailController->index($code['code'], $code['user_email']);

            return $code;
        } else {
            return response([
                'message' => 'User not found!!'
            ], 401);
        }
    }

}
