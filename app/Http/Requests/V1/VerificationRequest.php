<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest {
    public function authorize(): bool {
       return true;
    }

    public function rules(): array {
        return [
            'email' => ['required', 'string'],
            'code' => ['required', 'string']
        ];
    }
}
