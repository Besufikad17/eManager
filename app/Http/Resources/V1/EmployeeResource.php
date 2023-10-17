<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource {

    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'email' => $this->email,
            'phonenumber' => $this->phonenumber,
            'salary' => $this->salary,
            'addedAt' => $this->created_at
        ];
    }

}
