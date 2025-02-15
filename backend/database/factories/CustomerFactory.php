<?php

namespace Database\Factories;

use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Enum\CustomerStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf_cnpj' => $this->faker->numerify('###########'),
            'rg' => $this->faker->numerify('#########'),
            'status' => $this->faker->randomElement(CustomerStatusEnum::cases()),
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
