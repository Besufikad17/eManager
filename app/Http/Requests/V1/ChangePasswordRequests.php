<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

    public function authorize(): bool {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    public function rules(): array {
        return [
            'new_password' => ['required', 'string']
        ];
    }
}
