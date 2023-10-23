<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest {

    public function authorize(): bool {
       return true;
    }

    public function rules(): array {
        return [
            'title' => ['required', 'string'],
            'userId' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'user_id' => $this->userId
        ]);
    }
}
