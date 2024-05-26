<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MaritalStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new MaritalStatusSeeder())->run();
        
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        (new PersonalInformationSeeder())->run();
        (new AddressSeeder())->run();

        \App\Models\CheckingAccount::factory(1)->create();
    }
}
