<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRecoveryRequest extends FormRequest {

    public function authorize(): bool {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    public function rules(): array {
        return [
            'email' => ['required', 'string'],
        ];
    }
}
