<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory {
    public function definition(): array {
        return [
            'fname' => $this->faker->name(),
            'lname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phonenumber' => $this->faker->phoneNumber(),
            'password' => Hash::make(Str::random(8)),
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth()

        ];
    }

    public function unverified(): static {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
