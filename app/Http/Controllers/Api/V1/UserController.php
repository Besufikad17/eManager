<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\V1\EditProfileRequest;
use App\Http\Resources\V1\UserResource;

class UserController extends Controller {
    public function update(EditProfileRequest $request, string $id) {
        $user = User::find($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(string $id) {
        return User::destroy($id);
    }
}
