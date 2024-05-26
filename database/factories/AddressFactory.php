<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'user_id' => User::whereEmail('test@example.com')->first()->id,
            'zip_code' => $this->faker->numerify('########'),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->randomNumber(4),
            'neighborhood' => $this->faker->city(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
        ];
    }
}
