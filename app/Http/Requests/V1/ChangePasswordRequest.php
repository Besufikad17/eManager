<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'id' => ['sometimes'],
            'email' => ['sometimes', 'string'],
            'newPassword' => ['required', 'string']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'new_password' => $this->newPassword
        ]);
    }
}
