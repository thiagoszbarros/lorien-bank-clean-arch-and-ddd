<?php

namespace Database\Seeders;

use App\Models\PersonalInformation;
use Illuminate\Database\Seeder;

class PersonalInformationSeeder extends Seeder
{
    public function run(): void
    {
        PersonalInformation::factory()->create();
    }
}
