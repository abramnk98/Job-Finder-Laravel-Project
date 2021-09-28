<?php

namespace Database\Seeders;

use App\Models\CandidateProfile;
use App\Models\EmployeeProfile;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0 ; $i < 5; $i++) {

            $city = ['Cairo', 'Giza', 'El Minya'];

            $region = [
                'Cairo' => ['Shubra', 'Ramsis', 'Madent Nasr'],
                'Giza' => ['Fesal', 'Doki'],
                'El Minya' => ['Beni Mazar', 'Maghagha'],
            ];

            $city = $city[array_rand($city)];

            $region = $region[$city][array_rand($region[$city])];

            $name = ['Mohamed', 'Ahmed', 'Ali', 'Hazam'];

            $location = Location::create([
                "country" => 'Egypt',
                "city" => $city,
                "region" => $region,
                "building" => 120,
                "street" => 'El Gomhorya',
            ]);

            $first_name = $name[array_rand($name)];
            $last_name = $name[array_rand($name)];

            $user = User::create([
                'name' => $first_name. ' ' . $last_name,
                'email' => $first_name.rand(0,9).rand(0,9).rand(0,9)."@example.net",
                'email_verified_at' => now(),
                'password' => '$2y$10$nLnqrlAk2JLSlgFvqTPZ0.Jb1EwKSTYhkfhmByT6.JQrlvxbH8u..', // password 12345678
                'type' => 'candidate',
                'remember_token' => chr(10),
            ]);

            CandidateProfile::create([
                "first_name" => $first_name,
                "last_name" => $last_name,
                "careers" => rand(1,8) . ',' . rand(1,8) . ',' . rand(1,8) . ',',
                "phone" => intval('12'. rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9)),
                "photo" => 'person_'. rand(1,4). '.jpg',
                "location_id" => $location->id,
                "user_id" => $user->id,
            ]);

        }

        for ($i = 0 ; $i < 5; $i++) {

            $city = ['Cairo', 'Giza', 'El Minya'];

            $region = [
                'Cairo' => ['Shubra', 'Ramsis', 'Madent Nasr'],
                'Giza' => ['Fesal', 'Doki'],
                'El Minya' => ['Beni Mazar', 'Maghagha'],
            ];

            $city = $city[array_rand($city)];

            $region = array_rand($region[$city]);

            $name = ['Hassan', 'Mahmoud', 'Hossam', 'Abdalla'];

            $companies = ['SecureSmarter','Dwellsmith','SalePush','Formonix','Brandiing','Cloudrevel','Seekingo'];

            $location = Location::create([
                "country" => 'Egypt',
                "city" => $city,
                "region" => $region,
                "building" => 120,
                "street" => 'El Gomhorya',
            ]);

            $first_name = $name[array_rand($name)];
            $last_name = $name[array_rand($name)];

            $user = User::create([
                'name' => $first_name. ' ' . $last_name,
                'email' => $first_name.rand(0,9).rand(0,9).rand(0,9)."@example.net",
                'email_verified_at' => now(),
                'password' => '$2y$10$nLnqrlAk2JLSlgFvqTPZ0.Jb1EwKSTYhkfhmByT6.JQrlvxbH8u..', // password 12345678
                'type' => 'employee',
                'remember_token' => chr(10),
            ]);


             EmployeeProfile::create([
                "company_name" => $companies[array_rand($companies)],
                "first_name" => $first_name,
                "last_name" => $last_name,
                "phone" => intval('12'. rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9). rand(0,9)),
                "logo" => 'logo_'. rand(1,2). '.png',
                 "user_id" => $user->id,
            ]);

        }
    }
}
