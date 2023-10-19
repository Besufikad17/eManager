<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['required', 'email'],
            'phoneNumber' => ['required'],
            'password' => ['required']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'phonenumber' => $this->phoneNumber
        ]);
    }
}
