<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ChangePasswordRequest;
use App\Http\Requests\V1\EditProfileRequest;
use App\Http\Requests\V1\VerificationRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Models\VerificationCode;

class UserController extends Controller {
    public function show(string $id) {
        return new UserResource(User::find($id));
    }

    public function update(EditProfileRequest $request, string $id) {
        $user = User::find($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function verify(VerificationRequest $request) {
        $code = VerificationCode::where('user_email', $request['email'])
                ->latest()
                ->first();

        if(isset($code)) {
            if($code['code'] == $request['code']) {
               if(now()->diffInMinutes($code['created_at']) > 1440 || $code['expired']) {
                    $code->expired = true;
                    $code->save();

                    return response([
                        'message' => 'Verification code expired!!'
                    ], 401);
               } else if($code['verified']) {
                    return response([
                        'message' => 'User already verified!!'
                    ], 401);
               } else {
                    $code->verified = true;
                    $code->save();

                    return response([
                        'message' => 'Done!!'
                    ], 201);
               }
            } else {
                return response([
                    'message' => 'Incorrect verification code!!'
                ], 401);
            }
        } else {
            return response([
                'message' => 'Invalid verification code!!'
            ], 401);
        }
    }

    public function change_password(ChangePasswordRequest $request) {
        $user = !isset($request['id']) ?
                User::find($request['id']) :
                User::where('email', $request['email'])->first();

        $user->password = bcrypt($request['new_password']);
        $user->save();

        return response([
            'message' => 'Done!!'
        ], 201);
    }

    public function destroy(string $id) {
        return User::destroy($id);
    }
}
