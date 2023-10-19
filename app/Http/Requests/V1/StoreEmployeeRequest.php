<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['required'],
            'phoneNumber' => ['required'],
            'salary' => ['required']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'phonenumber' => $this->phoneNumber
        ]);
    }
}
