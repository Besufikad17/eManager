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
            'profile_picture_url' => "https://source.unsplash.com/random",
            'email' => $this->faker->safeEmail(),
            'phonenumber' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
            'dept' => $this->faker->randomElement(['Accounting', 'IT', 'Sales', 'HR']),
            'salary' => $this->faker->numberBetween(5000, 20000),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}
