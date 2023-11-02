<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest {

    public function authorize(): bool {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    public function rules(): array {
        return [
            'fname' => ['required'],
            'lname' => ['required'],
            'profilePictureUrl' => ['required'],
            'email' => ['required'],
            'phoneNumber' => ['required'],
            'dept' => ['required'],
            'dateOfBirth' => ['required']
            'salary' => ['required'],
            'gender' => ['required']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'profile_picture_url' => $this->profilePictureUrl,
            'phonenumber' => $this->phoneNumber,
            'date_of_birth' => $this->dateOfBirth
        ]);
    }
}
