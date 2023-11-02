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
            'profilePictureUrl' => $this->profile_picture_url,
            'email' => $this->email,
            'phoneNumber' => $this->phonenumber,
            'dept' => $this->dept,
            'date_of_birth' => $this->date_of_birth,
            'salary' => $this->salary,
            'gender' => $this->gender,
            'addedAt' => $this->created_at
        ];
    }

}
