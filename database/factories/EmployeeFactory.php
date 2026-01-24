<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(), // Akan jadi format Indonesia
            'address' => $this->faker->address(), // Alamat Indonesia
            'birth_date' => $this->faker->dateTimeBetween('-40 years', '-20 years'),
            'hire_date' => now(),
            'department_id' => $this->faker->numberBetween(1, 3),
            'role_id' => $this->faker->numberBetween(1, 3),
            'status' => 'active',
            'salary' => $this->faker->numberBetween(5000000, 15000000), // Gaji Rupiah
        ];
    }
}
