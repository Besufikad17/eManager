<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory {
    protected $model = Employee::class;

    public function definition() {
        return [
            'fname' => $this->faker->name(),
            'lname' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phonenumber' => $this->faker->phoneNumber(),
            'salary' => $this->faker->numberBetween(5000, 20000),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
