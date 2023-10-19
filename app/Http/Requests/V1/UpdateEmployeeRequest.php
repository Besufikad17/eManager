<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $requestMethod = $this->method();

        if($requestMethod == 'PUT') {
            return [
                'fname' => ['required'],
                'lname' => ['required'],
                'email' => ['required'],
                'phoneNumber' => ['required'],
                'salary' => ['required']
            ];
        } else {
            return [
                'fname' => ['sometimes', 'required'],
                'lname' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required'],
                'phoneNumber' => ['sometimes', 'required'],
                'salary' => ['sometimes', 'required']
            ];
        }
    }

    protected function prepareForValidation() {
        $this->merge([
            'phonenumber' => $this->phoneNumber
        ]);
    }
}
