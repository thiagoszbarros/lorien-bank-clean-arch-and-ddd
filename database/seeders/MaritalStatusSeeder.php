<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    public function run(): void
    {
        MaritalStatus::insert([
            ['name' => 'single'],
            ['name' => 'married'],
            ['name' => 'divorced'],
            ['name' => 'widowed'],
        ]);
    }
}
