<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(10),
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'is_self_pay' => $this->faker->boolean(30),
        ];
    }
}