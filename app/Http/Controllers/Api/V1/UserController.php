<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use App\Http\Requests\V1\EditProfileRequest;
use App\Http\Requests\V1\VerificationRequest;
use App\Http\Requests\V1\ChangePasswordRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use Carbon;

class UserController extends Controller {
    public function update(EditProfileRequest $request, string $id) {
        $user = User::find($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function verify(VerificationRequest $request) {
        $code = VerificationCode::where('user_email', $request['email'])->first();

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

    }

    public function destroy(string $id) {
        return User::destroy($id);
    }
}
