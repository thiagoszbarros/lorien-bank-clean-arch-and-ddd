<?php

namespace Database\Factories;

use App\Bussiness\Domain\ValueObjects\LorienBankNumber;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckingAccount>
 */
class CheckingAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_BR');

        return [
            'user_id' => User::whereEmail('test@example.com')->first()->id,
            'bank' => (new LorienBankNumber())->getValue(),
            'branch' => '0001',
            'number' => $faker->cpf(false),
            'digit' => '0',
        ];
    }
}
