<?php

namespace Database\Factories;

use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\MaritalStatus;
use App\Models\PersonalInformation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\PhoneNumber;

class PersonalInformationFactory extends Factory
{
    protected $model = PersonalInformation::class;
    public function definition(): array
    {
        return [
            'user_id' => User::whereEmail('test@example.com')->first()->id,
            'cellphone' => '55'. PhoneNumber::areaCode() . PhoneNumber::cellphone(false),
            'birth_date' => (new DateTime())->sub(new DateInterval('P18Y'))->format('Y-m-d'),
            'mother_full_name' => $this->faker->name(),
            'marital_status_id' => MaritalStatus::inRandomOrder()->first()->id,
            'is_pep' => $this->faker->boolean(),
            'monthly_income' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
