<?php

namespace Database\Seeders;

use App\Models\Testimony;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();
         \App\Models\Setting::factory(1)->create();
//         \App\Models\EmployeeProfile::factory(1)->create();
//         \App\Models\Service::factory(4)->create();

        $this->call([
            CareerSeeder::class,
            ServiceSeeder::class,
            TeamSeeder::class,
            FrequentlyQuestionSeeder::class,
            UserSeeder::class,
            JobSeeder::class,
        ]);
         \App\Models\Testimony::factory(10)->create();
    }
}
