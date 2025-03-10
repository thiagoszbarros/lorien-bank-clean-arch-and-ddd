<?php

namespace Database\Factories;

use App\Models\MaritalStatus;
use App\Models\PersonalInformation;
use App\Models\User;
use DateInterval;
use DateTime;
use Faker\Provider\pt_BR\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalInformationFactory extends Factory
{
    protected $model = PersonalInformation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::whereEmail('test@example.com')->first()->id,
            'rg' => $this->faker->numerify('###########'),
            'cnh' => $this->faker->numerify('###########'),
            'cellphone' => '55'.PhoneNumber::areaCode().PhoneNumber::cellphone(false),
            'birth_date' => (new DateTime())->sub(new DateInterval('P18Y'))->format('Y-m-d'),
            'mother_full_name' => $this->faker->name(),
            'marital_status_id' => MaritalStatus::inRandomOrder()->first()->id,
            'is_pep' => $this->faker->boolean(),
            'monthly_income' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
